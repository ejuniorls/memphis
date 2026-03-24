<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenAI;

class AiTranslate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ai:translate {file} {--from=pt_BR} {--to=en}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate language file using AI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');
        $from = $this->option('from');
        $to = $this->option('to');

        $pathFrom = lang_path("$from/$file.php");
        $pathTo = lang_path("$to/$file.php");

        if (!file_exists($pathFrom)) {
            $this->error("Arquivo não encontrado: $pathFrom");
            return;
        }

        $source = include $pathFrom;
        $target = file_exists($pathTo) ? include $pathTo : [];

        if (!is_array($target)) {
            $target = [];
        }

        // cria pasta se não existir
        $dir = dirname($pathTo);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // pega só o que falta traduzir
        $toTranslate = [];
        foreach ($source as $key => $value) {
            if (!isset($target[$key])) {
                $toTranslate[$key] = $value;
            }
        }

        if (empty($toTranslate)) {
            $this->info('Nada para traduzir');
            return;
        }

        $this->info('Traduzindo em lote...');

        $client = OpenAI::client(env('OPENAI_API_KEY'));

        foreach ($toTranslate as $key => $value) {

            // ignora se não for string
            if (!is_string($value)) {
                continue;
            }

            $this->info("Traduzindo: $key");

            try {
                $response = $client->chat()->create([
                    'model' => 'gpt-5-nano',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "You are a professional UI/UX translator.
                            Translate UI text from $from to $to.

                            Rules:
                            - Return ONLY the translated text
                            - No explanations
                            - Keep it short and natural for UI
                            - Use neutral language
                            "
                        ],
                        [
                            'role' => 'user',
                            'content' => $value
                        ]
                    ],
                ]);

                $translated = trim($response->choices[0]->message->content);

                $target[$key] = $translated;

            } catch (\Throwable $e) {
                $this->error("Erro ao traduzir $key: " . $e->getMessage());
            }
        }

        // salva
        $content = "<?php\n\nreturn " . var_export($target, true) . ";\n";

        file_put_contents($pathTo, $content);

        $this->info("Tradução concluída: $pathTo");
    }
}
