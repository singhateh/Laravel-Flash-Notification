@if (count($messages))
<script>
    @foreach ($messages as $message)
        FlashNotifier.open({
        message: " {{ $message['message'] }}",
        messageTextColor: "{{ config('flash.options.messageTextColor') }}",
        position: "{{ config('flash.options.position') }}",
        customClass: "{{ config('flash.options.customClass') }}",
        width: "{{ config('flash.options.width') }}",
        showCloseButton: "{{ config('flash.options.showCloseButton') }}",
        closeButtonText: "{{ config('flash.options.closeButtonText') }}",
        duration: "{{ config('flash.options.duration') }}",
        onClose: "{{ config('flash.options.onClose') }}",
        closeButtonTextColor: "{{ config('flash.options.closeTextColor') }}",
        backgroundColor: "{{ config('flash.options.backgroundColor.success') }}"
        });
    @endforeach
</script>

@endif
