CREATE VIEW restaurantsview AS 
SELECT typeres.typeres_id , restaurants.* FROM restaurants
INNER JOIN typeres ON restaurants.restaurants_type = typeres.typeres_id ; 


CREATE VIEW itemsview AS 
SELECT items.* , categories.* FROM items 
INNER JOIN categories ON categories.categories_id = items.items_cat ; 


CREATE VIEW subitemsview AS 
SELECT items.* , subitems.* FROM subitems 
INNER JOIN items ON  items.items_id = subitems.subitems_items ; 