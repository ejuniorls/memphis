<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Select')]
class extends Component {
    //
};
?>

@php
    $frameworks = ['react' => 'React', 'nextjs' => 'Next.js', 'angular' => 'Angular', 'vue' => 'Vue', 'svelte' => 'Svelte', 'ember' => 'Ember', 'nuxt' => 'Nuxt.js', 'remix' => 'Remix'];
    $countries  = ['us' => 'United States', 'de' => 'Germany', 'it' => 'Italy', 'fr' => 'France', 'es' => 'Spain', 'jp' => 'Japan', 'ru' => 'Russia', 'ca' => 'Canada'];

    // Configs com strings — sempre em @php para evitar aspas simples em atributos Blade
    $cfgScrollable    = ['optionsClass' => 'kt-scrollable overflow-auto max-h-[250px]'];
    $cfgSeparator     = ['displaySeparator' => ' | '];
    $cfgTeamTags      = ['enableSelectAll' => true, 'selectAllText' => 'Select All', 'clearAllText' => 'Clear All'];
    $cfgSkillsTags    = ['enableSelectAll' => true];
    $cfgCountSelected = ['showSelectedCount' => true, 'optionsClass' => 'kt-scrollable overflow-auto max-h-[250px]'];
    $cfgTeamSelected  = ['showSelectedCount' => true, 'selectedCountText' => '{{count}} team members', 'optionsClass' => 'kt-scrollable overflow-auto max-h-[250px]'];
    $cfgPlaceholder   = ['placeholderClass' => 'border-b border-dashed border-primary', 'placeholderTemplate' => '<span class=\"text-primary\">{{placeholder}}</span>'];
@endphp

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Advanced Select
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    KTSelect is a feature-rich, customizable dropdown component built with modern web standards. It offers single/multiple selection, search, and rich icon support with various styling options.
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a class="kt-btn kt-btn-outline" href="#">
                    Upload CSV
                </a>
                <a class="kt-btn kt-btn-primary" href="#">
                    Add User
                </a>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Container -->
    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">
                    {{-- 1. Basic Usage --}}
                    <x-ui.card title="Basic Usage">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select a framework" :options-scrollable="true">
                                @foreach ($frameworks as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 2. Placeholder Text --}}
                    <x-ui.card title="Placeholder Text">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Please select a field type..." :config="$cfgPlaceholder">
                                <option value="apple">Apple</option>
                                <option value="google">Google</option>
                                <option value="amazon">Amazon</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="keenthemes">Keenthemes</option>
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 3. Disabled Select --}}
                    <x-ui.card title="Disabled Select">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select a library..." :disabled="true">
                                <option value="reui">ReUI</option>
                                <option value="ktui" disabled>KtUI</option>
                                <option value="metronic">Metronic</option>
                                <option value="keenthemes">Keenthemes</option>
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 4. Disabled Option --}}
                    <x-ui.card title="Disabled Option">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select a framework...">
                                <option value="react">React</option>
                                <option value="nextjs" disabled>Next.js</option>
                                <option value="angular">Angular</option>
                                <option value="vue">Vue</option>
                                <option value="svelte" disabled>Svelte</option>
                                <option value="ember">Ember</option>
                                <option value="nuxt">Nuxt.js</option>
                                <option value="remix">Remix</option>
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 5. Size Variants --}}
                    <x-ui.card title="Size Variants">
                        <div class="kt-card-content flex flex-col gap-4">
                            <x-ui.select size="sm" placeholder="Small" :multiple="true" :options-scrollable="true">
                                @foreach ($frameworks as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                            <x-ui.select size="md" placeholder="Medium" :multiple="true" :options-scrollable="true">
                                @foreach ($frameworks as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                            <x-ui.select size="lg" placeholder="Large" :multiple="true" :options-scrollable="true">
                                @foreach ($frameworks as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 6. Multiple Selection --}}
                    <x-ui.card title="Multiple Selection">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select cities..." :multiple="true" :max-selections="3" :config="$cfgSeparator">
                                <option value="amsterdam">Amsterdam</option>
                                <option value="barcelona">Barcelona</option>
                                <option value="london">London</option>
                                <option value="new-york">New York</option>
                                <option value="paris">Paris</option>
                                <option value="rome">Rome</option>
                                <option value="tokyo">Tokyo</option>
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 7. Maximum Selection --}}
                    <x-ui.card title="Maximum Selection">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select up to 3 options" :multiple="true" :max-selections="3">
                                @foreach ($frameworks as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 8. Enhanced Tags --}}
                    <x-ui.card title="Enhanced Tags">
                        <div class="kt-card-content flex flex-col gap-8">
                            <div>
                                <label class="block mb-3 font-semibold text-foreground">Team Members</label>
                                <x-ui.select placeholder="Select team members..." :multiple="true" :tags="true" pre-selected="jenny,mike,david" :config="$cfgTeamTags">
                                    <option value="jenny">Jenny Wilson</option>
                                    <option value="mike">Mike Johnson</option>
                                    <option value="david">David Brown</option>
                                    <option value="sarah">Sarah Davis</option>
                                    <option value="alex">Alex Thompson</option>
                                    <option value="lisa">Lisa Anderson</option>
                                </x-ui.select>
                            </div>
                            <div>
                                <label class="block mb-3 font-semibold text-foreground">Countries</label>
                                <x-ui.select placeholder="Select countries..." :multiple="true" :tags="true" pre-selected="france,spain">
                                    <option value="france">France</option>
                                    <option value="spain">Spain</option>
                                    <option value="germany">Germany</option>
                                    <option value="italy">Italy</option>
                                    <option value="japan">Japan</option>
                                    <option value="canada">Canada</option>
                                </x-ui.select>
                            </div>
                            <div>
                                <label class="block mb-3 font-semibold text-foreground">Skills</label>
                                <x-ui.select placeholder="Select your skills..." :multiple="true" :tags="true" :config="$cfgSkillsTags">
                                    <option value="javascript">JavaScript</option>
                                    <option value="typescript">TypeScript</option>
                                    <option value="react">React</option>
                                    <option value="vue">Vue.js</option>
                                    <option value="angular">Angular</option>
                                    <option value="node">Node.js</option>
                                    <option value="python">Python</option>
                                    <option value="java">Java</option>
                                </x-ui.select>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 9. Basic Tags --}}
                    <x-ui.card title="Basic Tags">
                        <div class="kt-card-content">
                            <label class="block mb-3 font-semibold text-foreground">Countries</label>
                            <x-ui.select placeholder="Select countries..." :multiple="true" :tags="true">
                                @foreach ($countries as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 10. Pre-selected Tags --}}
                    <x-ui.card title="Pre-selected Tags">
                        <div class="kt-card-content">
                            <label class="block mb-3 font-semibold text-foreground">Countries</label>
                            <x-ui.select placeholder="Select countries..." :multiple="true" :tags="true" pre-selected="de,fr">
                                @foreach ($countries as $val => $label)
                                    <option value="{{ $val }}">{{ $label }}</option>
                                @endforeach
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 11. Tags: Selected Count --}}
                    <x-ui.card title="Tags: Selected Count">
                        <div class="kt-card-content flex flex-col gap-8 max-w-md">
                            <div>
                                <label class="block mb-3 font-semibold text-foreground">Default label</label>
                                <x-ui.select placeholder="Select countries..." :multiple="true" :tags="true" pre-selected="de,fr,it" :config="$cfgCountSelected">
                                    <option value="us">United States</option>
                                    <option value="de">Germany</option>
                                    <option value="it">Italy</option>
                                    <option value="fr">France</option>
                                    <option value="es">Spain</option>
                                    <option value="jp">Japan</option>
                                </x-ui.select>
                            </div>
                            <div>
                                <label class="block mb-3 font-semibold text-foreground">Custom label</label>
                                <x-ui.select placeholder="Select team members..." :multiple="true" :tags="true" pre-selected="jenny,mike" :config="$cfgTeamSelected">
                                    <option value="jenny">Jenny Wilson</option>
                                    <option value="mike">Mike Johnson</option>
                                    <option value="david">David Brown</option>
                                    <option value="sarah">Sarah Davis</option>
                                </x-ui.select>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 12. Search --}}
                    <x-ui.card title="Search">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Select a brand..." :search="true" :options-scrollable="true">
                                <option value="apple">Apple</option>
                                <option value="google">Google</option>
                                <option value="amazon">Amazon</option>
                                <option value="facebook">Facebook</option>
                                <option value="twitter">Twitter</option>
                                <option value="keenthemes">Keenthemes</option>
                                <option value="github">GitHub</option>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">YouTube</option>
                                <option value="linkedin">LinkedIn</option>
                                <option value="spotify">Spotify</option>
                                <option value="telegram">Telegram</option>
                                <option value="tiktok">TikTok</option>
                            </x-ui.select>
                        </div>
                    </x-ui.card>

                    {{-- 13. Remote Data --}}
                    <x-ui.card title="Remote Data">
                        <div class="kt-card-content">
                            <x-ui.select placeholder="Search users..." :remote="true" :search="true" data-url="https://jsonplaceholder.typicode.com/users" data-field-value="id" data-field-text="name" />
                        </div>
                    </x-ui.card>

                    {{-- 14. Country Selection --}}
                    <x-ui.card title="Country Selection">
                        <div class="kt-card-content">
                            @verbatim
                                <select
                                    class="kt-select"
                                    data-kt-select="true"
                                    data-kt-select-enable-search="true"
                                    data-kt-select-search-placeholder="Search..."
                                    data-kt-select-placeholder="Select a country..."
                                    data-kt-select-config='{
                    "displayTemplate": "<div class=\"flex items-center leading-none gap-2\">{{flag}}<span class=\"text-foreground\">{{text}}</span></div>",
                    "optionTemplate": "<div class=\"flex items-center leading-none gap-2\">{{flag}} <span class=\"text-foreground\">{{text}}</span></div><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"size-3.5 ms-auto hidden text-primary kt-select-option-selected:block\"><path d=\"M20 6 9 17l-5-5\"/></svg></div>"
                }'
                                >
                                    <option value="usa"       data-kt-select-option='{"flag": "🇺🇸"}'>USA</option>
                                    <option value="germany"   data-kt-select-option='{"flag": "🇩🇪"}'>Germany</option>
                                    <option value="italy"     data-kt-select-option='{"flag": "🇮🇹"}'>Italy</option>
                                    <option value="france"    data-kt-select-option='{"flag": "🇫🇷"}'>France</option>
                                    <option value="spain"     data-kt-select-option='{"flag": "🇪🇸"}'>Spain</option>
                                    <option value="canada"    data-kt-select-option='{"flag": "🇨🇦"}'>Canada</option>
                                    <option value="australia" data-kt-select-option='{"flag": "🇦🇺"}'>Australia</option>
                                    <option value="japan"     data-kt-select-option='{"flag": "🇯🇵"}'>Japan</option>
                                </select>
                            @endverbatim
                        </div>
                    </x-ui.card>

                    {{-- 15. Avatar --}}
                    <x-ui.card title="Avatar">
                        <div class="kt-card-content">
                            @verbatim
                                <select
                                    class="kt-select"
                                    data-kt-select="true"
                                    data-kt-select-enable-search="true"
                                    data-kt-select-search-placeholder="Search..."
                                    data-kt-select-placeholder="Select a user..."
                                    data-kt-select-config='{
                    "displayTemplate": "<div class=\"flex items-center gap-2\"><img src=\"{{avatar}}\" alt=\"{{text}}\" class=\"size-5 border border-input rounded-full\" /> <span class=\"text-foreground\">{{text}}</span></div>",
                    "optionTemplate": "<div class=\"flex items-center gap-2\"><img src=\"{{avatar}}\" alt=\"{{text}}\" class=\"size-6 border border-input rounded-full\" /> <span class=\"text-foreground\">{{text}}</span></div><svg viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"size-3.5 ms-auto hidden text-primary kt-select-option-selected:block\"><path d=\"M20 6 9 17l-5-5\"/></svg>",
                    "optionsClass": "kt-scrollable overflow-auto max-h-[250px]"
                }'
                                >
                                    <option value="1" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/women/68.jpg"}'>Ana Nilson</option>
                                    <option value="2" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/men/46.jpg"}'>Robert Brown</option>
                                    <option value="3" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/men/29.jpg"}'>John Doe</option>
                                    <option value="4" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/women/48.jpg"}' selected>Nina Erin</option>
                                    <option value="5" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/men/58.jpg"}'>Mark Larson</option>
                                    <option value="6" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/men/68.jpg"}'>Nick Strong</option>
                                    <option value="7" data-kt-select-option='{"avatar": "https://randomuser.me/api/portraits/women/58.jpg"}'>Kate Leo</option>
                                </select>
                            @endverbatim
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
