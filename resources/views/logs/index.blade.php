<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Logi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="[&>*:nth-child(2n)]:text-purple-500 flex flex-col gap-5 p-3 border-[4px] border-purple-500 rounded-[10px] bg-blue-100 shadow-2xl shadow-purple-500 sm:rounded-lg overflow-scroll h-[500px]">
                @foreach ($logs as $log)
                    <pre>{{ $log }}</pre>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
