<div class="flex flex-col space-y-2 gap-4" id="register">
    <div class="flex gap-4">
        <x-documentation.section-header>Register</x-documentation.section-header>
        <x-pill theme="success">POST</x-pill>
    </div>
    <x-documentation.section-description>Create and account and recieve a Bearer token</x-documentation.section-description>
    <x-documentation.section-subheader>Required Fields</x-documentation.section-subheader>

    <!-- Email -->
    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>email</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The email address you would like associated with your account</x-documentation.parameter-description>
        <hr />
    </div>

    <!-- Password -->
    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>password</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The password for your account</x-documentation.parameter-description>
        <hr />
    </div>

    <x-documentation.section-subheader>Optional Fields</x-documentation.section-subheader>

    <!-- Email -->
    <div class="flex flex-col gap-2 justify-center">
        <div class="flex gap-2 items-center">
            <x-pill>Name</x-pill>
            <x-documentation.parameter-type>string</x-documentation.parameter-type>
        </div>
        <x-documentation.parameter-description>The name we should address you by</x-documentation.parameter-description>
        <hr />
    </div>
</div>
