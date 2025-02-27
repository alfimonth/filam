<div>
    <div>
        <input type="radio" id="locale_id" wire:model="localId" name="locale" value="id"
            wire:click="switchLocale('id')">
        <label for="locale_id">ID</label>
    </div>
    <div>
        <input type="radio" id="locale_en" name="locale" wire:model="localEn" value="en"
            wire:click="switchLocale('en')">
        <label for="locale_en">EN</label>
    </div>
</div>
