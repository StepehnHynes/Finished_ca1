@if(session('success'))
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="alert alert-success">
                    {{ $slot }}
                </div>
            </div>
            @endif
