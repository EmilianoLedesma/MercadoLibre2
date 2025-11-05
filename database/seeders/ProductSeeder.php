<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios y categorías
        $userCount = User::count();
        if ($userCount === 0) {
            User::factory(5)->create();
        }
        
        $categoryCount = Category::count();
        if ($categoryCount === 0) {
            $this->call(CategorySeeder::class);
        }

                // Obtener categorías y usuarios para asignar
        $tecnologia = Category::where('name', 'Tecnología')->first();
        $electrodomesticos = Category::where('name', 'Electrodomésticos')->first();
        $hogar = Category::where('name', 'Hogar y Muebles')->first();
        $moda = Category::where('name', 'Moda')->first();
        $deportes = Category::where('name', 'Deportes y Fitness')->first();
        $juguetes = Category::where('name', 'Juguetes y Bebés')->first();
        $belleza = Category::where('name', 'Belleza y Cuidado Personal')->first();
        $herramientas = Category::where('name', 'Herramientas')->first();
        $libros = Category::where('name', 'Libros y Entretenimiento')->first();
        $automotriz = Category::where('name', 'Automotriz')->first();
        $jardin = Category::where('name', 'Jardín y Exterior')->first();
        $alimentos = Category::where('name', 'Alimentos y Bebidas')->first();
        
        $users = User::all();
        
        // Productos de Tecnología (10 productos)
        $techProducts = [
            ['name' => 'Samsung Galaxy A54 5G 128GB', 'price' => 389999, 'stock_quantity' => 45, 'description' => 'Smartphone Samsung Galaxy A54 con pantalla AMOLED de 6.4", cámara triple de 50MP y batería de 5000mAh'],
            ['name' => 'iPhone 13 128GB', 'price' => 899999, 'stock_quantity' => 20, 'description' => 'Apple iPhone 13 con chip A15 Bionic, cámara dual de 12MP y pantalla Super Retina XDR'],
            ['name' => 'Notebook Lenovo IdeaPad 3 15.6"', 'price' => 549999, 'stock_quantity' => 30, 'description' => 'Notebook con procesador Intel Core i5, 8GB RAM, SSD 256GB y Windows 11'],
            ['name' => 'Auriculares Sony WH-1000XM4', 'price' => 249999, 'stock_quantity' => 60, 'description' => 'Auriculares inalámbricos con cancelación de ruido premium, hasta 30 horas de batería'],
            ['name' => 'Tablet Samsung Galaxy Tab A8', 'price' => 179999, 'stock_quantity' => 35, 'description' => 'Tablet 10.5" con procesador octa-core, 4GB RAM y 64GB almacenamiento'],
            ['name' => 'Smart TV LG 50" 4K UHD', 'price' => 459999, 'stock_quantity' => 25, 'description' => 'Smart TV LED 50 pulgadas con resolución 4K, WebOS y HDR'],
            ['name' => 'MacBook Air M2 256GB', 'price' => 1299999, 'stock_quantity' => 12, 'description' => 'MacBook Air con chip M2, pantalla Retina de 13.6", 8GB RAM y 256GB SSD'],
            ['name' => 'Mouse Logitech MX Master 3', 'price' => 89999, 'stock_quantity' => 80, 'description' => 'Mouse inalámbrico ergonómico con sensor de alta precisión y 7 botones personalizables'],
            ['name' => 'Teclado Mecánico Razer BlackWidow', 'price' => 129999, 'stock_quantity' => 40, 'description' => 'Teclado mecánico gaming con switches Green, RGB Chroma y reposamuñecas'],
            ['name' => 'Webcam Logitech C920 HD Pro', 'price' => 79999, 'stock_quantity' => 55, 'description' => 'Cámara web Full HD 1080p con enfoque automático y micrófono estéreo'],
        ];

        // Productos de Electrodomésticos (10 productos)
        $electroProducts = [
            ['name' => 'Heladera No Frost Whirlpool 340L', 'price' => 699999, 'stock_quantity' => 15, 'description' => 'Heladera con freezer, tecnología No Frost, eficiencia energética A+'],
            ['name' => 'Lavarropas Automático Samsung 7kg', 'price' => 449999, 'stock_quantity' => 20, 'description' => 'Lavarropas carga frontal con 12 programas de lavado y display digital'],
            ['name' => 'Microondas BGH Quick Chef 23L', 'price' => 89999, 'stock_quantity' => 40, 'description' => 'Microondas con grill, 800W de potencia y 8 niveles'],
            ['name' => 'Aire Acondicionado Split 3000W', 'price' => 379999, 'stock_quantity' => 18, 'description' => 'Aire acondicionado frío/calor con gas ecológico R410A y control remoto'],
            ['name' => 'Licuadora Philips HR2096', 'price' => 64999, 'stock_quantity' => 65, 'description' => 'Licuadora de 600W con jarra de vidrio de 1.5L y 5 velocidades'],
            ['name' => 'Cafetera Express Oster', 'price' => 149999, 'stock_quantity' => 30, 'description' => 'Cafetera espresso automática con molinillo integrado y espumador de leche'],
            ['name' => 'Aspiradora Robot iRobot Roomba', 'price' => 399999, 'stock_quantity' => 22, 'description' => 'Aspiradora robot inteligente con mapeo, app móvil y recarga automática'],
            ['name' => 'Horno Eléctrico Atma 50L', 'price' => 119999, 'stock_quantity' => 28, 'description' => 'Horno eléctrico con grill, luz interior y bandeja giratoria'],
            ['name' => 'Plancha a Vapor Black+Decker', 'price' => 34999, 'stock_quantity' => 90, 'description' => 'Plancha a vapor 1200W con suela antiadherente y sistema antigoteo'],
            ['name' => 'Ventilador de Pie Liliana 20"', 'price' => 44999, 'stock_quantity' => 75, 'description' => 'Ventilador de pie con 3 velocidades, altura regulable y oscilación automática'],
        ];

        // Productos de Hogar y Muebles (10 productos)
        $hogarProducts = [
            ['name' => 'Juego de Sábanas 2 Plazas', 'price' => 24999, 'stock_quantity' => 80, 'description' => 'Juego de sábanas 100% algodón con funda de almohada incluida'],
            ['name' => 'Mesa Comedor Madera 6 Personas', 'price' => 159999, 'stock_quantity' => 12, 'description' => 'Mesa rectangular de madera maciza con acabado natural, incluye 6 sillas'],
            ['name' => 'Sillón Relax Reclinable', 'price' => 229999, 'stock_quantity' => 10, 'description' => 'Sillón reclinable tapizado en ecocuero con reposapiés extensible'],
            ['name' => 'Lámpara de Pie Moderna', 'price' => 34999, 'stock_quantity' => 55, 'description' => 'Lámpara de pie LED con brazo ajustable y dimmer integrado'],
            ['name' => 'Alfombra Pelo Alto 160x230cm', 'price' => 89999, 'stock_quantity' => 35, 'description' => 'Alfombra suave de pelo alto con base antideslizante, varios colores'],
            ['name' => 'Espejo de Pared Decorativo', 'price' => 54999, 'stock_quantity' => 42, 'description' => 'Espejo redondo con marco dorado, 80cm de diámetro, estilo moderno'],
            ['name' => 'Set de Toallas 6 Piezas', 'price' => 18999, 'stock_quantity' => 95, 'description' => 'Set de toallas 100% algodón: 2 de baño, 2 de mano y 2 faciales'],
            ['name' => 'Cortinas Blackout 140x220cm', 'price' => 29999, 'stock_quantity' => 60, 'description' => 'Cortinas opacas térmicas con aislamiento, bloquean 99% de luz'],
            ['name' => 'Perchero de Pie Minimalista', 'price' => 19999, 'stock_quantity' => 70, 'description' => 'Perchero de madera con 8 ganchos, base circular estable'],
            ['name' => 'Cojines Decorativos Set 4 Unidades', 'price' => 14999, 'stock_quantity' => 88, 'description' => 'Set de cojines 45x45cm con fundas removibles y relleno de fibra'],
        ];

        // Productos de Moda (10 productos)
        $modaProducts = [
            ['name' => 'Zapatillas Nike Air Max', 'price' => 129999, 'stock_quantity' => 65, 'description' => 'Zapatillas deportivas con tecnología Air Max y diseño urbano'],
            ['name' => 'Jean Levi\'s 501 Original', 'price' => 79999, 'stock_quantity' => 90, 'description' => 'Jean clásico de corte recto, 100% algodón denim'],
            ['name' => 'Campera The North Face', 'price' => 189999, 'stock_quantity' => 30, 'description' => 'Campera impermeable con capucha y aislamiento térmico'],
            ['name' => 'Remera Adidas Originals', 'price' => 29999, 'stock_quantity' => 120, 'description' => 'Remera de algodón con logo bordado y corte regular'],
            ['name' => 'Vestido Zara Floral', 'price' => 49999, 'stock_quantity' => 45, 'description' => 'Vestido midi con estampado floral, mangas cortas y cinturón'],
            ['name' => 'Buzo Hoodie Puma', 'price' => 59999, 'stock_quantity' => 78, 'description' => 'Buzo con capucha, bolsillo canguro y logo bordado'],
            ['name' => 'Botas de Cuero Dr. Martens', 'price' => 169999, 'stock_quantity' => 35, 'description' => 'Botas de cuero genuino con suela AirWair y 8 ojales'],
            ['name' => 'Gorra New Era Yankees', 'price' => 24999, 'stock_quantity' => 100, 'description' => 'Gorra 9FIFTY con logo bordado y ajuste snapback'],
            ['name' => 'Reloj Casio G-Shock', 'price' => 89999, 'stock_quantity' => 52, 'description' => 'Reloj digital resistente al agua con cronómetro y alarma'],
            ['name' => 'Mochila Eastpak Padded', 'price' => 44999, 'stock_quantity' => 85, 'description' => 'Mochila urbana con compartimento para laptop y 30 años de garantía'],
        ];

        // Productos de Deportes y Fitness (10 productos)
        $deportesProducts = [
            ['name' => 'Bicicleta Mountain Bike R29', 'price' => 349999, 'stock_quantity' => 15, 'description' => 'Bicicleta todo terreno con cambios Shimano 21 velocidades y suspensión delantera'],
            ['name' => 'Pelota de Fútbol Nike', 'price' => 19999, 'stock_quantity' => 75, 'description' => 'Pelota oficial tamaño 5 con tecnología Aerowtrac'],
            ['name' => 'Mancuernas Set 20kg', 'price' => 44999, 'stock_quantity' => 40, 'description' => 'Set de mancuernas ajustables con discos revestidos en goma'],
            ['name' => 'Colchoneta Yoga Premium', 'price' => 14999, 'stock_quantity' => 85, 'description' => 'Mat de yoga antideslizante de 6mm con bolso de transporte'],
            ['name' => 'Cinta de Correr Profesional', 'price' => 599999, 'stock_quantity' => 8, 'description' => 'Cinta motorizada plegable con pantalla LCD y 12 programas'],
            ['name' => 'Pesas Rusas Kettlebell 12kg', 'price' => 34999, 'stock_quantity' => 55, 'description' => 'Kettlebell de hierro fundido con recubrimiento vinílico'],
            ['name' => 'Raqueta de Tenis Wilson', 'price' => 79999, 'stock_quantity' => 28, 'description' => 'Raqueta profesional con marco de grafito y grip antideslizante'],
            ['name' => 'Botines Adidas Predator', 'price' => 119999, 'stock_quantity' => 48, 'description' => 'Botines de fútbol con tapones para césped natural'],
            ['name' => 'Guantes de Boxeo Everlast', 'price' => 39999, 'stock_quantity' => 62, 'description' => 'Guantes de boxeo 12oz con relleno de espuma y cierre de velcro'],
            ['name' => 'Banco Musculación Multifunción', 'price' => 229999, 'stock_quantity' => 18, 'description' => 'Banco ajustable con soporte para barras y extensiones de piernas'],
        ];

        // Productos de Juguetes y Bebés (10 productos)
        $juguetesProducts = [
            ['name' => 'LEGO Star Wars Millennium Falcon', 'price' => 89999, 'stock_quantity' => 25, 'description' => 'Set de construcción con 1351 piezas, incluye 7 minifiguras'],
            ['name' => 'Carriola Infanti 3 en 1', 'price' => 279999, 'stock_quantity' => 12, 'description' => 'Sistema modular: carriola, moisés y silla para auto'],
            ['name' => 'Muñeca Barbie Dreamhouse', 'price' => 54999, 'stock_quantity' => 35, 'description' => 'Casa de muñecas de 3 pisos con muebles y accesorios'],
            ['name' => 'Hot Wheels Pista Mega Salto', 'price' => 34999, 'stock_quantity' => 50, 'description' => 'Pista de autos con loop y rampa de salto, incluye 2 vehículos'],
            ['name' => 'Pañales Pampers Premium Care', 'price' => 29999, 'stock_quantity' => 120, 'description' => 'Paquete de 72 pañales talla M con tecnología absorbente'],
            ['name' => 'Silla de Comer Chicco Polly', 'price' => 149999, 'stock_quantity' => 22, 'description' => 'Silla alta con bandeja removible y 7 posiciones de altura'],
            ['name' => 'Juego de Mesa Monopoly', 'price' => 24999, 'stock_quantity' => 68, 'description' => 'Juego clásico de propiedades para 2-8 jugadores'],
            ['name' => 'Peluche Osito Gigante 120cm', 'price' => 44999, 'stock_quantity' => 30, 'description' => 'Peluche suave y abrazable, relleno hipoalergénico'],
            ['name' => 'Biberones Dr. Browns Set 4', 'price' => 19999, 'stock_quantity' => 95, 'description' => 'Set de biberones anticólicos con sistema de ventilación'],
            ['name' => 'Triciclo Fisher-Price', 'price' => 79999, 'stock_quantity' => 38, 'description' => 'Triciclo evolutivo con barra de empuje y protección solar'],
        ];

        // Productos de Belleza y Cuidado Personal (10 productos)
        $bellezaProducts = [
            ['name' => 'Perfume Carolina Herrera Good Girl', 'price' => 149999, 'stock_quantity' => 40, 'description' => 'Eau de Parfum 80ml con notas de jazmín y almendra'],
            ['name' => 'Set Maquillaje MAC Professional', 'price' => 199999, 'stock_quantity' => 22, 'description' => 'Kit completo con paleta de sombras, labiales y brochas'],
            ['name' => 'Secador de Pelo Philips 2200W', 'price' => 39999, 'stock_quantity' => 50, 'description' => 'Secador profesional con tecnología iónica y 6 velocidades'],
            ['name' => 'Crema Facial La Roche-Posay', 'price' => 34999, 'stock_quantity' => 75, 'description' => 'Crema hidratante con ácido hialurónico y SPF 30'],
            ['name' => 'Shampoo Pantene Restauración', 'price' => 8999, 'stock_quantity' => 150, 'description' => 'Shampoo reparador 400ml para cabello dañado'],
            ['name' => 'Plancha de Pelo BaByliss PRO', 'price' => 89999, 'stock_quantity' => 35, 'description' => 'Plancha profesional de cerámica con control de temperatura'],
            ['name' => 'Kit Cuidado de Uñas Revlon', 'price' => 24999, 'stock_quantity' => 82, 'description' => 'Set completo de manicura con esmaltes y herramientas'],
            ['name' => 'Cepillo Eléctrico Oral-B', 'price' => 54999, 'stock_quantity' => 60, 'description' => 'Cepillo de dientes eléctrico recargable con sensor de presión'],
            ['name' => 'Mascarilla Facial Garnier', 'price' => 4999, 'stock_quantity' => 200, 'description' => 'Mascarilla purificante de carbón activado, uso único'],
            ['name' => 'Depiladora Láser Philips Lumea', 'price' => 399999, 'stock_quantity' => 15, 'description' => 'Depiladora de luz pulsada con sensor de tono de piel'],
        ];

        // Productos de Herramientas (10 productos)
        $herramientasProducts = [
            ['name' => 'Taladro Inalámbrico Bosch 20V', 'price' => 89999, 'stock_quantity' => 30, 'description' => 'Taladro percutor con batería de litio y maletín incluido'],
            ['name' => 'Juego de Llaves Combinadas 12 Piezas', 'price' => 24999, 'stock_quantity' => 60, 'description' => 'Set de llaves métricas cromadas de 8mm a 19mm'],
            ['name' => 'Sierra Circular Eléctrica 1400W', 'price' => 64999, 'stock_quantity' => 25, 'description' => 'Sierra circular con guía láser y profundidad de corte ajustable'],
            ['name' => 'Kit de Herramientas Mecánico 120 Piezas', 'price' => 44999, 'stock_quantity' => 45, 'description' => 'Maletín con herramientas profesionales para mecánica automotor'],
            ['name' => 'Amoladora Angular DeWalt 900W', 'price' => 79999, 'stock_quantity' => 32, 'description' => 'Amoladora de 4.5" con empuñadura lateral y protector'],
            ['name' => 'Nivel Láser Stanley Cross90', 'price' => 59999, 'stock_quantity' => 38, 'description' => 'Nivel láser de líneas cruzadas con autonivelación'],
            ['name' => 'Soldadora Inverter 200A', 'price' => 119999, 'stock_quantity' => 18, 'description' => 'Soldadora eléctrica portátil con display digital'],
            ['name' => 'Compresor de Aire 50L', 'price' => 149999, 'stock_quantity' => 12, 'description' => 'Compresor de 2HP con tanque de 50 litros y kit de accesorios'],
            ['name' => 'Escalera Telescópica de Aluminio', 'price' => 89999, 'stock_quantity' => 22, 'description' => 'Escalera extensible hasta 3.8m, carga máxima 150kg'],
            ['name' => 'Pistola de Calor Black+Decker', 'price' => 34999, 'stock_quantity' => 48, 'description' => 'Pistola de aire caliente 1800W con 2 niveles de temperatura'],
        ];

        // Productos de Libros y Entretenimiento (10 productos)
        $librosProducts = [
            ['name' => 'Cien Años de Soledad - García Márquez', 'price' => 12999, 'stock_quantity' => 100, 'description' => 'Edición de bolsillo del clásico de literatura latinoamericana'],
            ['name' => 'PlayStation 5 Digital Edition', 'price' => 599999, 'stock_quantity' => 8, 'description' => 'Consola de nueva generación con SSD ultra rápido y Ray Tracing'],
            ['name' => 'Guitarra Acústica Fender', 'price' => 159999, 'stock_quantity' => 18, 'description' => 'Guitarra acústica de cuerdas de acero con funda incluida'],
            ['name' => 'Harry Potter Colección Completa', 'price' => 49999, 'stock_quantity' => 65, 'description' => 'Box set con los 7 libros de la saga en tapa dura'],
            ['name' => 'Nintendo Switch OLED', 'price' => 399999, 'stock_quantity' => 15, 'description' => 'Consola híbrida con pantalla OLED de 7" y Joy-Con'],
            ['name' => 'El Principito - Antoine de Saint-Exupéry', 'price' => 8999, 'stock_quantity' => 150, 'description' => 'Edición ilustrada del clásico infantil'],
            ['name' => 'Vinilo The Beatles Abbey Road', 'price' => 34999, 'stock_quantity' => 42, 'description' => 'Vinilo LP remasterizado del icónico álbum'],
            ['name' => 'Juego FIFA 24 PS5', 'price' => 79999, 'stock_quantity' => 50, 'description' => 'Simulador de fútbol con licencias oficiales y modo carrera'],
            ['name' => 'Audífonos Inalámbricos JBL', 'price' => 59999, 'stock_quantity' => 70, 'description' => 'Auriculares Bluetooth con 20 horas de batería y micrófono'],
            ['name' => '1984 - George Orwell', 'price' => 10999, 'stock_quantity' => 88, 'description' => 'Novela distópica clásica en edición de bolsillo'],
        ];

        // Productos de Automotriz (10 productos)
        $automotrizProducts = [
            ['name' => 'Cubierta Pirelli 185/65 R15', 'price' => 54999, 'stock_quantity' => 80, 'description' => 'Neumático para auto con tecnología Run Flat'],
            ['name' => 'Batería Moura 12V 75Ah', 'price' => 89999, 'stock_quantity' => 35, 'description' => 'Batería libre de mantenimiento con 24 meses de garantía'],
            ['name' => 'Limpia Parabrisas Bosch AeroTwin', 'price' => 18999, 'stock_quantity' => 110, 'description' => 'Par de escobillas limpiaparabrisas premium con tecnología aerodinamica'],
            ['name' => 'Aceite Castrol Edge 5W-30 4L', 'price' => 24999, 'stock_quantity' => 120, 'description' => 'Aceite sintético para motor con tecnología Fluid Titanium'],
            ['name' => 'Aspiradora Auto Black+Decker', 'price' => 34999, 'stock_quantity' => 65, 'description' => 'Aspiradora portátil 12V con accesorios y cable de 5m'],
            ['name' => 'Cargador de Batería Inteligente', 'price' => 29999, 'stock_quantity' => 48, 'description' => 'Cargador automático de 6A con protección contra sobrecarga'],
            ['name' => 'Funda Cubre Asientos Universal', 'price' => 19999, 'stock_quantity' => 95, 'description' => 'Set de fundas de poliéster resistente para asientos delanteros y traseros'],
            ['name' => 'Cámara de Retroceso con Pantalla', 'price' => 49999, 'stock_quantity' => 38, 'description' => 'Sistema de visión trasera con monitor LCD de 4.3 pulgadas'],
            ['name' => 'Compresor de Aire Portátil', 'price' => 39999, 'stock_quantity' => 52, 'description' => 'Inflador de neumáticos 12V con manómetro digital'],
            ['name' => 'Pastillas de Freno Bosch', 'price' => 29999, 'stock_quantity' => 72, 'description' => 'Juego de pastillas de freno cerámicas para eje delantero'],
        ];

        // Productos de Jardín y Exterior (10 productos)
        $jardinProducts = [
            ['name' => 'Cortacésped Eléctrico 1400W', 'price' => 179999, 'stock_quantity' => 18, 'description' => 'Cortadora de césped con bolsa recolectora de 35L y ancho de corte 35cm'],
            ['name' => 'Set de Herramientas de Jardín', 'price' => 24999, 'stock_quantity' => 55, 'description' => 'Kit de 5 piezas: pala, rastrillo, tijera, transplantador y cepillo'],
            ['name' => 'Manguera Extensible 30m', 'price' => 14999, 'stock_quantity' => 85, 'description' => 'Manguera de riego flexible que se expande con pistola multifunción'],
            ['name' => 'Sombrilla de Jardín 3m', 'price' => 89999, 'stock_quantity' => 25, 'description' => 'Parasol octogonal con manivela de apertura y protección UV'],
            ['name' => 'Macetas de Fibrocemento Set 3', 'price' => 34999, 'stock_quantity' => 42, 'description' => 'Set de macetas decorativas resistentes a la intemperie'],
            ['name' => 'Bordeadora Eléctrica 450W', 'price' => 59999, 'stock_quantity' => 32, 'description' => 'Recortadora de bordes con cabezal giratorio y protector'],
            ['name' => 'Sistema de Riego Automático', 'price' => 79999, 'stock_quantity' => 28, 'description' => 'Kit de riego por goteo con temporizador para hasta 20 plantas'],
            ['name' => 'Parrilla a Carbón con Tapa', 'price' => 129999, 'stock_quantity' => 20, 'description' => 'Parrilla redonda de 57cm con termómetro y ruedas'],
            ['name' => 'Luces Solares de Jardín Pack 8', 'price' => 19999, 'stock_quantity' => 70, 'description' => 'Estacas LED con panel solar y sensor de luz automático'],
            ['name' => 'Compostadora 300L', 'price' => 44999, 'stock_quantity' => 15, 'description' => 'Compostera de plástico reciclado con sistema de ventilación'],
        ];

        // Productos de Alimentos y Bebidas (10 productos)
        $alimentosProducts = [
            ['name' => 'Café Martínez Premium 1kg', 'price' => 12999, 'stock_quantity' => 120, 'description' => 'Café molido premium de origen argentino, tueste medio ideal para espresso'],
            ['name' => 'Aceite de Oliva Extra Virgen 750ml', 'price' => 24999, 'stock_quantity' => 85, 'description' => 'Aceite de oliva extra virgen primera presión en frío, origen mediterráneo'],
            ['name' => 'Dulce de Leche Havanna 450g', 'price' => 8999, 'stock_quantity' => 150, 'description' => 'Dulce de leche artesanal argentino con textura cremosa y sabor intenso'],
            ['name' => 'Vino Malbec Catena Zapata', 'price' => 34999, 'stock_quantity' => 60, 'description' => 'Vino tinto Malbec reserva 750ml, añejado en barrica de roble francés'],
            ['name' => 'Chocolate Lindt Excellence 70%', 'price' => 6999, 'stock_quantity' => 200, 'description' => 'Tableta de chocolate amargo 100g con 70% cacao y notas intensas'],
            ['name' => 'Miel Pura Orgánica 500g', 'price' => 14999, 'stock_quantity' => 95, 'description' => 'Miel de flores silvestres orgánica sin pasteurizar ni aditivos'],
            ['name' => 'Té Verde Taragüí Premium', 'price' => 5999, 'stock_quantity' => 180, 'description' => 'Té verde en saquitos con antioxidantes naturales, 25 unidades'],
            ['name' => 'Mermelada Artesanal Frutos Rojos', 'price' => 9999, 'stock_quantity' => 110, 'description' => 'Mermelada casera de frutos rojos 400g con 60% de frutas'],
            ['name' => 'Aceitunas Rellenas Nucete 500g', 'price' => 7999, 'stock_quantity' => 140, 'description' => 'Aceitunas verdes rellenas con morrón, en salmuera natural'],
            ['name' => 'Yerba Mate Rosamonte 1kg', 'price' => 4999, 'stock_quantity' => 250, 'description' => 'Yerba mate tradicional argentina con palo, sabor suave y equilibrado'],
        ];
        
        // Productos de Tecnología
        $techProducts = [
            ['name' => 'Samsung Galaxy A54 5G 128GB', 'price' => 389999, 'stock_quantity' => 45, 'description' => 'Smartphone Samsung Galaxy A54 con pantalla AMOLED de 6.4", cámara triple de 50MP y batería de 5000mAh'],
            ['name' => 'iPhone 13 128GB', 'price' => 899999, 'stock_quantity' => 20, 'description' => 'Apple iPhone 13 con chip A15 Bionic, cámara dual de 12MP y pantalla Super Retina XDR'],
            ['name' => 'Notebook Lenovo IdeaPad 3 15.6"', 'price' => 549999, 'stock_quantity' => 30, 'description' => 'Notebook con procesador Intel Core i5, 8GB RAM, SSD 256GB y Windows 11'],
            ['name' => 'Auriculares Sony WH-1000XM4', 'price' => 249999, 'stock_quantity' => 60, 'description' => 'Auriculares inalámbricos con cancelación de ruido premium, hasta 30 horas de batería'],
            ['name' => 'Tablet Samsung Galaxy Tab A8', 'price' => 179999, 'stock_quantity' => 35, 'description' => 'Tablet 10.5" con procesador octa-core, 4GB RAM y 64GB almacenamiento'],
            ['name' => 'Smart TV LG 50" 4K UHD', 'price' => 459999, 'stock_quantity' => 25, 'description' => 'Smart TV LED 50 pulgadas con resolución 4K, WebOS y HDR'],
            ['name' => 'MacBook Air M2 256GB', 'price' => 1299999, 'stock_quantity' => 12, 'description' => 'MacBook Air con chip M2, pantalla Retina de 13.6", 8GB RAM y 256GB SSD'],
            ['name' => 'Mouse Logitech MX Master 3', 'price' => 89999, 'stock_quantity' => 80, 'description' => 'Mouse inalámbrico ergonómico con sensor de alta precisión y 7 botones personalizables'],
            ['name' => 'Teclado Mecánico Razer BlackWidow', 'price' => 129999, 'stock_quantity' => 40, 'description' => 'Teclado mecánico gaming con switches Green, RGB Chroma y reposamuñecas'],
            ['name' => 'Webcam Logitech C920 HD Pro', 'price' => 79999, 'stock_quantity' => 55, 'description' => 'Cámara web Full HD 1080p con enfoque automático y micrófono estéreo'],
        ];

        // Productos de Electrodomésticos
        $electroProducts = [
            ['name' => 'Heladera No Frost Whirlpool 340L', 'price' => 699999, 'stock_quantity' => 15, 'description' => 'Heladera con freezer, tecnología No Frost, eficiencia energética A+'],
            ['name' => 'Lavarropas Automático Samsung 7kg', 'price' => 449999, 'stock_quantity' => 20, 'description' => 'Lavarropas carga frontal con 12 programas de lavado y display digital'],
            ['name' => 'Microondas BGH Quick Chef 23L', 'price' => 89999, 'stock_quantity' => 40, 'description' => 'Microondas con grill, 800W de potencia y 8 niveles'],
            ['name' => 'Aire Acondicionado Split 3000W', 'price' => 379999, 'stock_quantity' => 18, 'description' => 'Aire acondicionado frío/calor con gas ecológico R410A y control remoto'],
            ['name' => 'Licuadora Philips HR2096', 'price' => 64999, 'stock_quantity' => 65, 'description' => 'Licuadora de 600W con jarra de vidrio de 1.5L y 5 velocidades'],
            ['name' => 'Cafetera Express Oster', 'price' => 149999, 'stock_quantity' => 30, 'description' => 'Cafetera espresso automática con molinillo integrado y espumador de leche'],
            ['name' => 'Aspiradora Robot iRobot Roomba', 'price' => 399999, 'stock_quantity' => 22, 'description' => 'Aspiradora robot inteligente con mapeo, app móvil y recarga automática'],
            ['name' => 'Horno Eléctrico Atma 50L', 'price' => 119999, 'stock_quantity' => 28, 'description' => 'Horno eléctrico con grill, luz interior y bandeja giratoria'],
            ['name' => 'Plancha a Vapor Black+Decker', 'price' => 34999, 'stock_quantity' => 90, 'description' => 'Plancha a vapor 1200W con suela antiadherente y sistema antigoteo'],
            ['name' => 'Ventilador de Pie Liliana 20"', 'price' => 44999, 'stock_quantity' => 75, 'description' => 'Ventilador de pie con 3 velocidades, altura regulable y oscilación automática'],
        ];

        // Productos de Hogar y Muebles
        $hogarProducts = [
            ['name' => 'Juego de Sábanas 2 Plazas', 'price' => 24999, 'stock_quantity' => 80, 'description' => 'Juego de sábanas 100% algodón con funda de almohada incluida'],
            ['name' => 'Mesa Comedor Madera 6 Personas', 'price' => 159999, 'stock_quantity' => 12, 'description' => 'Mesa rectangular de madera maciza con acabado natural, incluye 6 sillas'],
            ['name' => 'Sillón Relax Reclinable', 'price' => 229999, 'stock_quantity' => 10, 'description' => 'Sillón reclinable tapizado en ecocuero con reposapiés extensible'],
            ['name' => 'Lámpara de Pie Moderna', 'price' => 34999, 'stock_quantity' => 55, 'description' => 'Lámpara de pie LED con brazo ajustable y dimmer integrado'],
            ['name' => 'Alfombra Pelo Alto 160x230cm', 'price' => 89999, 'stock_quantity' => 35, 'description' => 'Alfombra suave de pelo alto con base antideslizante, varios colores'],
            ['name' => 'Espejo de Pared Decorativo', 'price' => 54999, 'stock_quantity' => 42, 'description' => 'Espejo redondo con marco dorado, 80cm de diámetro, estilo moderno'],
            ['name' => 'Set de Toallas 6 Piezas', 'price' => 18999, 'stock_quantity' => 95, 'description' => 'Set de toallas 100% algodón: 2 de baño, 2 de mano y 2 faciales'],
            ['name' => 'Cortinas Blackout 140x220cm', 'price' => 29999, 'stock_quantity' => 60, 'description' => 'Cortinas opacas térmicas con aislamiento, bloquean 99% de luz'],
            ['name' => 'Perchero de Pie Minimalista', 'price' => 19999, 'stock_quantity' => 70, 'description' => 'Perchero de madera con 8 ganchos, base circular estable'],
            ['name' => 'Cojines Decorativos Set 4 Unidades', 'price' => 14999, 'stock_quantity' => 88, 'description' => 'Set de cojines 45x45cm con fundas removibles y relleno de fibra'],
        ];

        // Productos de Moda
        $modaProducts = [
            ['name' => 'Zapatillas Nike Air Max', 'price' => 129999, 'stock_quantity' => 65, 'description' => 'Zapatillas deportivas con tecnología Air Max y diseño urbano'],
            ['name' => 'Jean Levi\'s 501 Original', 'price' => 79999, 'stock_quantity' => 90, 'description' => 'Jean clásico de corte recto, 100% algodón denim'],
            ['name' => 'Campera The North Face', 'price' => 189999, 'stock_quantity' => 30, 'description' => 'Campera impermeable con capucha y aislamiento térmico'],
            ['name' => 'Remera Adidas Originals', 'price' => 29999, 'stock_quantity' => 120, 'description' => 'Remera de algodón con logo bordado y corte regular'],
            ['name' => 'Vestido Zara Floral', 'price' => 49999, 'stock_quantity' => 45, 'description' => 'Vestido midi con estampado floral, mangas cortas y cinturón'],
            ['name' => 'Buzo Hoodie Puma', 'price' => 59999, 'stock_quantity' => 78, 'description' => 'Buzo con capucha, bolsillo canguro y logo bordado'],
            ['name' => 'Botas de Cuero Dr. Martens', 'price' => 169999, 'stock_quantity' => 35, 'description' => 'Botas de cuero genuino con suela AirWair y 8 ojales'],
            ['name' => 'Gorra New Era Yankees', 'price' => 24999, 'stock_quantity' => 100, 'description' => 'Gorra 9FIFTY con logo bordado y ajuste snapback'],
            ['name' => 'Reloj Casio G-Shock', 'price' => 89999, 'stock_quantity' => 52, 'description' => 'Reloj digital resistente al agua con cronómetro y alarma'],
            ['name' => 'Mochila Eastpak Padded', 'price' => 44999, 'stock_quantity' => 85, 'description' => 'Mochila urbana con compartimento para laptop y 30 años de garantía'],
        ];

        // Crear todos los productos
        $allProducts = [
            [$techProducts, $tecnologia],
            [$electroProducts, $electrodomesticos],
            [$hogarProducts, $hogar],
            [$modaProducts, $moda],
            [$deportesProducts, $deportes],
            [$juguetesProducts, $juguetes],
            [$bellezaProducts, $belleza],
            [$herramientasProducts, $herramientas],
            [$librosProducts, $libros],
            [$automotrizProducts, $automotriz],
            [$jardinProducts, $jardin],
            [$alimentosProducts, $alimentos],
        ];

        foreach ($allProducts as [$products, $category]) {
            if (!$category) continue;
            
            foreach ($products as $productData) {
                // Generar slug único basado en el nombre
                $baseSlug = \Illuminate\Support\Str::slug($productData['name']);
                $slug = $baseSlug;
                $counter = 1;
                
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                
                // Generar SKU único
                $sku = 'ML-' . strtoupper(substr($category->name, 0, 3)) . '-' . rand(10000, 99999);
                while (Product::where('sku', $sku)->exists()) {
                    $sku = 'ML-' . strtoupper(substr($category->name, 0, 3)) . '-' . rand(10000, 99999);
                }
                
                Product::create([
                    'name' => $productData['name'],
                    'slug' => $slug,
                    'description' => $productData['description'],
                    'short_description' => substr($productData['description'], 0, 150),
                    'sku' => $sku,
                    'price' => $productData['price'],
                    'stock_quantity' => $productData['stock_quantity'],
                    'category_id' => $category->id,
                    'user_id' => $users->random()->id,
                    'images' => json_encode(['images/placeholder-product.svg']),
                    'is_active' => true,
                    'is_featured' => rand(1, 100) <= 20, // 20% de productos destacados
                ]);
            }
        }
    }
}

