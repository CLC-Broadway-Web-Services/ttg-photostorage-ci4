<?php
$user = $response['user'] ? $response['user'] : "WyJtYWlzYXJhQHR0Z2xvYmFsLmNvbSIsMTU5NjUyMjYxMywyMDc3OTg3MDE3XQ==";
$nwtoken = update_token($user['email']);
