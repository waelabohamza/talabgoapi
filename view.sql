CREATE VIEW restaurantsview AS 
SELECT typeres.typeres_id , restaurants.* FROM restaurants
INNER JOIN typeres ON restaurants.restaurants_type = typeres.typeres_id ; 


CREATE VIEW itemsfoodview AS 
SELECT itemsfood.* , categoriesfood.* FROM itemsfood 
INNER JOIN categoriesfood ON categoriesfood.categoriesfood_id = itemsfood.itemsfood_cat ; 


CREATE VIEW subitemsfoodview AS 
SELECT itemsfood.* , subitemsfood.* FROM subitemsfood 
INNER JOIN itemsfood ON  itemsfood.itemsfood_id = subitemsfood.subitemsfood_items ; 