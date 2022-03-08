@if(session()->has('success'))
    <x-alert icon="check-circle-fill" type="success" :message="session()->get('success')"></x-alert>
@endif

@if(session()->has('error'))
    <x-alert icon="exclamation-triangle-fill" type="danger" :message="session()->get('error')"></x-alert>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <x-alert icon="exclamation-triangle-fill" type="warning" :message="$error"></x-alert>
    @endforeach
@endif