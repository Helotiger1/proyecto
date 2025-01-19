CREATE DATABASE noticias;

USE noticias;

CREATE TABLE IF NOT EXISTS `tbl_noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titular` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `url_imagen` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `url_noticia` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `visible` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `tbl_noticias` (`id`, `titular`, `url_imagen`, `url_noticia`, `fecha`, `visible`, `categoria`) VALUES
(1, 'Luna de las Flores: Cuándo y cómo ver la ÚLTIMA Superluna del año', 'https://cdn.heraldodemexico.com.mx/wp-content/uploads/2020/05/07163345/superluna-ultima-7-de-mayo-2020-luna-llena-lluvia-de-estrellas-cuarentena-cielo-espacio.jpg', 'https://heraldodemexico.com.mx/tendencias/ultima-superluna-del-ano-luna-de-las-flores-fenomenos-naturales-naturaleza-espacio-jueves-7-de-mayo-2020/', '2020-05-07', 'si', 'Medicina'),
(2, '3 años después de su lanzamiento, puedes comprar el Samsung Galaxy S8 a precio de Xiaomi, ¡70% de descuento!', 'https://andro4all.com/files/2019/09/Samsung-Galaxy-S8-700x500.jpg', 'https://andro4all.com/ofertas/oferta-descuento-samsung-galaxy-s8', '2020-05-08', 'si', 'Ciencia y Tecnología'),
(3, 'Alta demanda de Switch y superventas de ‘Animal Crossing’ impulsan a Nintendo', 'https://cdn.forbes.com.mx/2017/03/bloggif_58c8715cc52a8-768x432.jpeg', 'https://www.forbes.com.mx/negocios-switch-animal-crossing-ventas-nintendo/', '2020-05-08', 'si', 'Ciencia y Tecnología'),
(4, 'WhatsApp y Netflix se unen: ahora podrás ver tus series y películas desde la app de mensajería', 'https://d33nllpiqx4xq6.cloudfront.net/files/Publicacion/1195300/Foto/note_picture/net-301960.jpg', 'https://www.noroeste.com.mx/publicaciones/view/whatsapp-y-netflix-se-unen-ahora-podras-ver-tus-series-y-peliculas-desde-la-app-de-mensajeria-1195300', '2020-05-08', 'si', 'Ciencia y Tecnología'),
(5, 'El plan de China y Rusia para construir una estación espacial en la Luna', 'https://ichef.bbci.co.uk/news/800/cpsprodpb/E6B5/production/_117516095_gettyimages-1031182150.jpg', 'https://www.bbc.com/mundo/noticias-56346295', '2021-03-11', 'si', 'Ciencia y Tecnología');
