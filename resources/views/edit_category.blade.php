<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('view-category') }}">
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
                <form method="POST" action="/update-category" enctype='multipart/form-data'>
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
                        <input id="cid" class="block mt-1 w-full" type="hidden" name="cid" value="{{$category->id}}" required />
                        <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$category->name}}" required/>
                    </div>
                    <!-- Image -->
                    <div class="mt-4">
                        <x-label for="image" :value="__('Image')" />
                        <input id="image" class="" type="file" name="image"   />
                    </div>
                    <div class="mt-4">
                        <img src="{{$category->image}}" width='60' height="60">
                    </div>
                
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4">
                            {{ __('Udpate') }}
                        </x-button>
                        <!-- <button type="submit" class='btn btn-primary'>ADD</button>  -->
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>