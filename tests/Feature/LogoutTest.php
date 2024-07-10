<?php

it('user can logout', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});
