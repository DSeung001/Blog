@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Chat</div>
            <div class="card-body">
                <chat-messages :message="message"></chat-messages>
            </div>
            <div class="card-footer">
                <chat-form v-on:messagesent="addMessage" :user="{{Auth::user()}}"></chat-form>
            </div>
        </div>
    </div>
@stop