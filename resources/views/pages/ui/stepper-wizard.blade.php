<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('New Project Wizard')]
class extends Component {
    //
}; ?>

<div class="kt-page">

    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">New Project Wizard</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Exemplo de stepper avançado de 5 etapas com conteúdo realista.
                </div>
            </div>
        </div>
    </div>

    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">


                @php
                    $circle = 'relative shrink-0 rounded-full size-10 flex items-center justify-center text-sm font-semibold bg-muted text-muted-foreground kt-stepper-item-active:bg-primary kt-stepper-item-active:text-primary-foreground kt-stepper-item-active:ring-4 kt-stepper-item-active:ring-primary/15 kt-stepper-item-completed:bg-green-500 kt-stepper-item-completed:text-white transition-all duration-200';
                    $line = 'flex-1 h-0.5 bg-border mx-2 mt-[-28px] kt-stepper-item-completed:bg-green-500 transition-colors duration-300';
                @endphp

                <x-ui.card title="New Project Setup">

                    <div class="kt-card-content p-0" wire:ignore>
                        <form action="#" method="post">
                            <div data-kt-stepper="true">
                                <div class="kt-card rounded-none border-0 border-t border-border shadow-none">

                                    {{-- Navegação — 5 steps clicáveis (já preenchidos podem ser revisitados) --}}
                                    <div class="kt-card-header w-full h-auto px-8 py-6">
                                        <div class="flex items-start w-full">

                                            <div data-kt-stepper-item="#step_1" class="active flex flex-col items-center gap-2 text-center w-28 shrink-0">
                                                <button type="button" data-stepper-go="1" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">1</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Project</h4>
                                                    <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Name & type</span>
                                                </div>
                                            </div>

                                            <div class="{{ $line }}"></div>

                                            <div data-kt-stepper-item="#step_2" class="flex flex-col items-center gap-2 text-center w-28 shrink-0">
                                                <button type="button" data-stepper-go="2" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">2</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Team</h4>
                                                    <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Invite members</span>
                                                </div>
                                            </div>

                                            <div class="{{ $line }}"></div>

                                            <div data-kt-stepper-item="#step_3" class="flex flex-col items-center gap-2 text-center w-28 shrink-0">
                                                <button type="button" data-stepper-go="3" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">3</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Resources</h4>
                                                    <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Files & budget</span>
                                                </div>
                                            </div>

                                            <div class="{{ $line }}"></div>

                                            <div data-kt-stepper-item="#step_4" class="flex flex-col items-center gap-2 text-center w-28 shrink-0">
                                                <button type="button" data-stepper-go="4" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">4</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Integrations</h4>
                                                    <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Connect tools</span>
                                                </div>
                                            </div>

                                            <div class="{{ $line }}"></div>

                                            <div data-kt-stepper-item="#step_5" class="flex flex-col items-center gap-2 text-center w-28 shrink-0">
                                                <button type="button" data-stepper-go="5" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">5</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Launch</h4>
                                                    <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Review & create</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Conteúdo — altura E largura fixas para nada pular entre steps --}}
                                    <div class="kt-card-content flex items-start justify-center px-6 py-10 h-[520px] overflow-y-auto">
                                        <div class="w-full max-w-lg shrink-0">

                                            {{-- Step 1: Project name & type --}}
                                            <div id="step_1" class="space-y-6">
                                                <div class="text-center">
                                                    <h3 class="text-lg font-semibold text-mono">Let's name your project</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">Give it a clear name and pick a type.</p>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Project name <span class="text-destructive">*</span></label>
                                                    <div class="kt-form-control">
                                                        <x-ui.input type="text" placeholder="e.g. Website Redesign" value="Q3 Marketing Campaign" />
                                                    </div>
                                                    <div class="kt-form-description">This will be visible to your whole team.</div>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Project type</label>
                                                    <div class="grid grid-cols-3 gap-3">
                                                        <label class="kt-card cursor-pointer p-4 text-center border-2 border-border has-[:checked]:border-primary has-[:checked]:bg-primary/5 transition-colors">
                                                            <input type="radio" name="project_type" value="marketing" class="sr-only" checked />
                                                            @svg('lucide-megaphone', ['class' => 'size-5 mx-auto text-mono'])
                                                            <div class="text-xs font-medium text-mono mt-2">Marketing</div>
                                                        </label>
                                                        <label class="kt-card cursor-pointer p-4 text-center border-2 border-border has-[:checked]:border-primary has-[:checked]:bg-primary/5 transition-colors">
                                                            <input type="radio" name="project_type" value="dev" class="sr-only" />
                                                            @svg('lucide-code-2', ['class' => 'size-5 mx-auto text-mono'])
                                                            <div class="text-xs font-medium text-mono mt-2">Development</div>
                                                        </label>
                                                        <label class="kt-card cursor-pointer p-4 text-center border-2 border-border has-[:checked]:border-primary has-[:checked]:bg-primary/5 transition-colors">
                                                            <input type="radio" name="project_type" value="design" class="sr-only" />
                                                            @svg('lucide-palette', ['class' => 'size-5 mx-auto text-mono'])
                                                            <div class="text-xs font-medium text-mono mt-2">Design</div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Description</label>
                                                    <div class="kt-form-control">
                                                        <textarea class="kt-input min-h-[90px]" placeholder="What's this project about?">Launch campaign for the new product line across all channels.</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Step 2: Team --}}
                                            <div id="step_2" class="hidden space-y-6">
                                                <div class="text-center">
                                                    <h3 class="text-lg font-semibold text-mono">Invite your team</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">Add collaborators — you can do this later too.</p>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Invite by email</label>
                                                    <div class="flex gap-2">
                                                        <div class="kt-form-control flex-1">
                                                            <x-ui.input type="email" icon="mail" placeholder="colleague@company.com" />
                                                        </div>
                                                        <x-ui.button type="button" :outline="true">Add</x-ui.button>
                                                    </div>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Team members</label>
                                                    <div class="kt-card border border-border">
                                                        <div class="kt-card-content divide-y divide-border p-0">
                                                            @foreach ([
                                                                ['name' => 'Jenny Wilson', 'email' => 'jenny@company.com', 'role' => 'Owner'],
                                                                ['name' => 'Mike Johnson', 'email' => 'mike@company.com', 'role' => 'Editor'],
                                                                ['name' => 'David Brown', 'email' => 'david@company.com', 'role' => 'Viewer'],
                                                            ] as $member)
                                                                <div class="flex items-center justify-between px-4 py-3">
                                                                    <div class="flex items-center gap-3">
                                                                        <div class="kt-avatar size-8">
                                                                            <div class="kt-avatar-image">
                                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}&size=32" alt="{{ $member['name'] }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="text-sm font-medium text-mono">{{ $member['name'] }}</div>
                                                                            <div class="text-xs text-muted-foreground">{{ $member['email'] }}</div>
                                                                        </div>
                                                                    </div>
                                                                    <x-ui.badge variant="secondary" style="outline" size="sm">{{ $member['role'] }}</x-ui.badge>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Step 3: Resources --}}
                                            <div id="step_3" class="hidden space-y-6">
                                                <div class="text-center">
                                                    <h3 class="text-lg font-semibold text-mono">Files & budget</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">Upload reference files and set a budget.</p>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Reference files</label>
                                                    <div class="kt-card border-2 border-dashed border-border p-8 text-center hover:border-primary/50 transition-colors cursor-pointer">
                                                        @svg('lucide-upload-cloud', ['class' => 'size-8 mx-auto text-muted-foreground'])
                                                        <p class="text-sm text-mono font-medium mt-3">Click to upload or drag and drop</p>
                                                        <p class="text-xs text-muted-foreground mt-1">PDF, PNG, JPG up to 10MB</p>
                                                    </div>
                                                    <div class="flex items-center justify-between mt-3 px-3 py-2 rounded-md bg-muted/50">
                                                        <div class="flex items-center gap-2">
                                                            @svg('lucide-file-text', ['class' => 'size-4 text-muted-foreground'])
                                                            <span class="text-sm text-mono">brand-guidelines.pdf</span>
                                                        </div>
                                                        <span class="text-xs text-muted-foreground">2.4 MB</span>
                                                    </div>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Budget range</label>
                                                    <div class="kt-form-control">
                                                        <div class="kt-input-group">
                                                            <span class="kt-input-addon">$</span>
                                                            <input class="kt-input" type="number" placeholder="5,000" value="12000" />
                                                            <span class="kt-input-addon">USD</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-form-item">
                                                    <label class="kt-form-label">Priority</label>
                                                    <div class="flex gap-2">
                                                        <label class="kt-badge kt-badge-lg cursor-pointer has-[:checked]:kt-badge-primary">
                                                            <input type="radio" name="priority" value="low" class="sr-only" /> Low
                                                        </label>
                                                        <label class="kt-badge kt-badge-lg cursor-pointer has-[:checked]:kt-badge-primary">
                                                            <input type="radio" name="priority" value="medium" class="sr-only" checked /> Medium
                                                        </label>
                                                        <label class="kt-badge kt-badge-lg cursor-pointer has-[:checked]:kt-badge-primary">
                                                            <input type="radio" name="priority" value="high" class="sr-only" /> High
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Step 4: Integrations --}}
                                            <div id="step_4" class="hidden space-y-6">
                                                <div class="text-center">
                                                    <h3 class="text-lg font-semibold text-mono">Connect your tools</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">Select integrations to sync with this project.</p>
                                                </div>

                                                <div class="space-y-3">
                                                    @foreach ([
                                                        ['name' => 'Slack', 'desc' => 'Get notified in your channel', 'icon' => 'message-square', 'checked' => true],
                                                        ['name' => 'Google Drive', 'desc' => 'Sync project files automatically', 'icon' => 'hard-drive', 'checked' => true],
                                                        ['name' => 'Jira', 'desc' => 'Link tickets and track progress', 'icon' => 'kanban-square', 'checked' => false],
                                                        ['name' => 'GitHub', 'desc' => 'Connect repositories', 'icon' => 'github', 'checked' => false],
                                                    ] as $tool)
                                                        <label class="kt-card flex items-center justify-between p-4 cursor-pointer border border-border hover:border-primary/40 transition-colors">
                                                            <div class="flex items-center gap-3">
                                                                <div class="size-9 rounded-lg bg-muted flex items-center justify-center">
                                                                    @svg('lucide-' . $tool['icon'], ['class' => 'size-4 text-mono'])
                                                                </div>
                                                                <div>
                                                                    <div class="text-sm font-medium text-mono">{{ $tool['name'] }}</div>
                                                                    <div class="text-xs text-muted-foreground">{{ $tool['desc'] }}</div>
                                                                </div>
                                                            </div>
                                                            <input type="checkbox" class="kt-checkbox" @checked($tool['checked']) />
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- Step 5: Review & launch --}}
                                            <div id="step_5" class="hidden space-y-6">
                                                <div class="text-center">
                                                    @svg('lucide-rocket', ['class' => 'size-10 text-primary mx-auto'])
                                                    <h3 class="text-lg font-semibold text-mono mt-3">Ready to launch</h3>
                                                    <p class="text-sm text-muted-foreground mt-1">Review everything before creating your project.</p>
                                                </div>

                                                <div class="kt-card border border-border">
                                                    <div class="kt-card-content divide-y divide-border p-0">
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Project name</span>
                                                            <span class="text-sm font-medium text-mono">Q3 Marketing Campaign</span>
                                                        </div>
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Type</span>
                                                            <x-ui.badge variant="primary" style="outline" size="sm">Marketing</x-ui.badge>
                                                        </div>
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Team</span>
                                                            <span class="text-sm font-medium text-mono">3 members</span>
                                                        </div>
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Budget</span>
                                                            <span class="text-sm font-medium text-mono">$12,000 USD</span>
                                                        </div>
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Priority</span>
                                                            <x-ui.badge variant="warning" style="light" size="sm">Medium</x-ui.badge>
                                                        </div>
                                                        <div class="flex items-center justify-between px-4 py-3">
                                                            <span class="text-sm text-muted-foreground">Integrations</span>
                                                            <span class="text-sm font-medium text-mono">Slack, Google Drive</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <label class="flex items-start gap-2.5">
                                                    <input type="checkbox" class="kt-checkbox kt-checkbox-sm mt-0.5" checked />
                                                    <span class="text-sm text-muted-foreground">I confirm this information is correct and want to create the project now.</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Footer --}}
                                    <div class="kt-card-footer justify-between p-5">
                                        <div>
                                            <button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">
                                                @svg('lucide-arrow-left') Back
                                            </button>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <button type="button" class="kt-btn kt-btn-ghost text-muted-foreground kt-stepper-last:hidden">Save draft</button>
                                            <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">
                                                Next @svg('lucide-arrow-right')
                                            </button>
                                            <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">
                                                @svg('lucide-rocket') Create project
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </x-ui.card>

            </div>
        </div>
    </div>

</div>
