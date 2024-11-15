<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    @if (session()->has($type))
  <div class="alert alert-{{ $type }}">
    {{ session($type) }}
  </div>
  @endif 
</div>