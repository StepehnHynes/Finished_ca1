<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<x-alert-success>
    {{ session('success') }}
    </x-alert-success>

<a href="{{route('products.create') }}" class="btn-link btn-lg mb-2">+ New Product</a>

           @forelse ($products as $product)
           <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
            <h2 class="font-bold text-2xl">
               <a href="{{route('products.show', $product)}}"> {{ $product->title }}</a>
            </h2>

            <p class ="mt-2">
                {{ Str::limit($product->text, 200) }}
            </p>
            <span class="block mt-4 text-sm opacity-70">{{$product->updated_at->diffForHumans()}}</span>
           </div>
@empty
<p>you have no products yet</p>
@endforelse

{{$products->links()}}
        </div>
    </div>
</x-app-layout>
