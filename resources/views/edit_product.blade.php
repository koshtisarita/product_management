<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('view-product') }}">
                    {{ __('View') }}
        </a>
    </x-slot>
     

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if(Session::has('success'))
                     <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('success')" />  			
                    
                @endif
                @if(Session::has('error'))
                <x-auth-session-status class="mb-4" :status="session('error')" />  
                @endif 
                @foreach ($errors as $message)
                    <span class="input-error">{{ $message }}</span>
                @endforeach 
                <form method="POST" action="/update-product" enctype='multipart/form-data'>
                    @csrf
                    <div>
                        <x-label for="category" :value="__('Category')" />
                        <select id="category" name="category"  style="width: 100px;" required>
                            <option value="" selected>{{$product->category_name}}</option>
                            @foreach($categories as $c)
                               <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>   
                   </div>
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <input type='hidden' value="{{$product->id}}" name="pid" id="pid">
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$product->name}}" required autofocus />
                    </div>
                     <!-- price -->
                     <div>
                        <x-label for="price" :value="__('Price')" />

                        <x-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{$product->price}}" required/>
                    </div>
                     <!-- Name -->
                     <div>
                        <x-label for="name" :value="__('Quantity')" />

                        <x-input id="qty" class="block mt-1 w-full" type="number" name="qty" value="{{$product->quantity}}" required/>
                    </div>
                    <!-- Image -->
                    <div class="mt-4">
                        <x-label for="image" :value="__('Image')" />
                        <input id="image" class="" type="file" name="image" />
                    </div>
                   
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Update') }}
                        </x-button>
                        <!-- <button type="submit" class='btn btn-primary'>ADD</button>  -->
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>