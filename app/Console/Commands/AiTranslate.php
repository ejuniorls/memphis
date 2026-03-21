<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use OpenAI;

class AiTranslate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:ai-translate';
    protected $signature = 'ai:translate {file} {--from=en} {--to=pt}';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
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

        $apiKey = env('GEMINI_API_KEY');
        $projectId = '743069271348'; // seu project ID
        $location = 'us-central1';
        $model = 'gemini-1.5-chat';

        foreach ($source as $key => $value) {

            // pula se já traduzido
            if (isset($target[$key])) {
                continue;
            }

            $this->info("Traduzindo: $key");

            // monta requisição para Gemini
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post(
                "https://$location-aiplatform.googleapis.com/v1/projects/$projectId/locations/$location/publishers/google/models/$model:predict",
                [
                    'instances' => [
                        ['content' => $value]
                    ],
                    'parameters' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 256
                    ]
                ]
            );

            if (!$response->ok()) {
                $this->error("Erro ao traduzir '$key': " . $response->body());
                continue;
            }

            $predictions = $response->json('predictions');
            $translated = trim($predictions[0]['content'] ?? '');

            $target[$key] = $translated;
        }

        // salva arquivo
        $content = "<?php\n\nreturn " . var_export($target, true) . ";\n";
        file_put_contents($pathTo, $content);

        $this->info("Tradução concluída: $pathTo");
    }
}
