<?php

test('the application returns a successful response', function () {
    $response = $this->get('/suggestions');

    $response->assertStatus(200);
});
