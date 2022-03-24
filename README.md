# TTG-PHOTOSTORAGE

database tables updates needed
> update ttg_post set device_type=NULL where device_type NOT IN ('Desktop', 'Notebook', 'Other Device');