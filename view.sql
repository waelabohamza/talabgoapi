CREATE VIEW restaurantsview AS 
SELECT typeres.typeres_id , restaurants.* FROM restaurants
INNER JOIN typeres ON restaurants.restaurants_type = typeres.typeres_id ; 