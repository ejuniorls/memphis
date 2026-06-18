<!-- Toolbar -->
@isset($toolbar)
    <div class="pb-5">
        <div class="kt-container-fixed flex items-center justify-between flex-wrap gap-3">
            <div class="flex flex-col flex-wrap gap-1">
                {{ $toolbar }}
            </div>
            <div class="flex items-center flex-wrap gap-1.5 lg:gap-2.5">
                @isset($toolbarActions)
                    {{ $toolbarActions }}
                @endisset
            </div>
        </div>
    </div>
@endisset
<!-- End of Toolbar -->
