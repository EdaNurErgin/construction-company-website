<?php

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/Repositories/ServiceRepository.php';

// Hizmet repository nesnesini olustur
$serviceRepository = new ServiceRepository();

// Veritabanindan en son 3 hizmeti getir
$latestServices = $serviceRepository->getLatest(3);

// Anasayfa gorunumunu yukle
require __DIR__ . '/../app/Views/pages/home.php';
