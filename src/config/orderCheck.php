<?php

return [
    'checkTimeout' => 10, // how much time (in minutes) we wait before trying to check the same order again
    'checkInterval' => 1, // check for orders updates on every X minutes
    'pendingStatus' => 3,
    'checkApiStatus' => 15, // status that represents the ready for approval status
];