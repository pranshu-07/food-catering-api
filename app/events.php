<?php

User::creating(function($user){
	$user->api_key = Str::random(32);
});