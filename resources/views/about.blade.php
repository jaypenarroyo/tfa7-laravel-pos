@extends('layouts.app')

@section('title', 'About | POS Foundations')

@section('content')
<section class="page-hero">
    <div class="container narrow">
        <p class="eyebrow">About the application</p>
        <h1>Turning a database listing into an editable POS application.</h1>
        <p class="lead">TFA7 adds validated create and edit workflows plus safe profile-picture uploads to the database-backed Laravel POS.</p>
    </div>
</section>

<section class="section">
    <div class="container two-column">
        <div>
            <h2>Purpose</h2>
            <p>The application demonstrates a complete Laravel form workflow: routes select controller actions, controllers validate requests, Eloquent models save approved values, and Blade views display errors or success messages.</p>
            <p>Uploaded profile pictures are validated, cropped into display-ready avatars, written to Laravel's public storage disk, and represented in the database by a relative path.</p>
        </div>
        <div class="stack-list">
            <article><strong>Routes</strong><span>Named index, create, store, edit, and update routes</span></article>
            <article><strong>Validation</strong><span>Required fields, valid emails, unique usernames, and image rules</span></article>
            <article><strong>Views</strong><span>Reusable form partials with old input and field-level errors</span></article>
            <article><strong>File storage</strong><span>240 x 240 avatars on the public disk with a safe placeholder</span></article>
        </div>
    </div>
</section>
@endsection
