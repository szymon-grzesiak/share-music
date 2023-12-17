<div class="text-left mb-4">
    <label for="input-{{ $view->id }}" class="block">
        <input wire:model="filters.{{ $view->id }}" id="input-{{ $view->id }}" name="filters[{{ $view->id }}]" class="appearance-none w-full bg-white border-gray-300 hover:border-gray-500 px-3 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:border-2 border">
    </label>
</div>
