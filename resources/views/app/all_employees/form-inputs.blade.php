@php $editing = isset($employees) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $employees->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="position" label="Position">
            @php $selected = old('position', ($editing ? $employees->position : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="salary"
            label="Salary"
            :value="old('salary', ($editing ? $employees->salary : ''))"
            max="255"
            step="0.01"
            placeholder="Salary"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="hired_date"
            label="Hired Date"
            value="{{ old('hired_date', ($editing ? optional($employees->hired_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
