@props(['placeholder' => 'select options', 'id'])
<div wire:ignore>
    <select class="select2 select2-hidden-accessible" multiple="multiple" data-placeholder="{{ $placeholder }}"
        id="{{ $id }}" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
        {{ $slot }}
    </select>
</div>

@once
    @push('js')
        <!-- Select2 -->
        <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    @endpush
@endonce

@push('js')
    <script>
        $(function() {
            $('#{{ $id }}').select2({
                theme: "bootstrap4"
            }).on('change', function() {
                @this.set("{{ $attributes->whereStartsWith('wire:model')->first() }}", $(this).val());
            });
        });
    </script>
@endpush

@once
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    @endpush
@endonce
