-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 août 2018 à 11:45
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet5`
--

-- --------------------------------------------------------

--
-- Structure de la table `ocp5_avatar`
--

DROP TABLE IF EXISTS `ocp5_avatar`;
CREATE TABLE IF NOT EXISTS `ocp5_avatar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ocp5_comment`
--

DROP TABLE IF EXISTS `ocp5_comment`;
CREATE TABLE IF NOT EXISTS `ocp5_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `commentDate` datetime NOT NULL,
  `report` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FFD4A952AA5D4036` (`story_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ocp5_comment`
--

INSERT INTO `ocp5_comment` (`id`, `author`, `message`, `commentDate`, `report`, `story_id`) VALUES
(14, 'Guest2', 'Belle histoire! Merci.', '2018-08-24 12:27:35', 0, 12);

-- --------------------------------------------------------

--
-- Structure de la table `ocp5_members`
--

DROP TABLE IF EXISTS `ocp5_members`;
CREATE TABLE IF NOT EXISTS `ocp5_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `votesReceived` int(11) NOT NULL,
  `votesNumber` int(11) NOT NULL,
  `registerDate` datetime NOT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2E0029C1465A626E` (`emailAddress`),
  UNIQUE KEY `UNIQ_2E0029C1F85E0677` (`username`),
  UNIQUE KEY `UNIQ_2E0029C186383B10` (`avatar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ocp5_members`
--

INSERT INTO `ocp5_members` (`id`, `username`, `password`, `emailAddress`, `votesReceived`, `votesNumber`, `registerDate`, `avatar_id`, `salt`, `roles`) VALUES
(12, 'Guest', '$2y$15$4GUJrjEW4C5jKKiANw8Aye7ZpOZ7D.hH2SZdYfh5p2Nvhcq4SqdEO', 'test@xyz.com', 21, 3, '2018-07-19 13:09:48', NULL, '', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(13, 'Guest2', '$2a$04$0BcCXv.CX9estr6MLnNZTeBT84wOn7mEHSMZ3EuuY2SwMST0Ht1Qi', 'test2@xyz.com', 15, 3, '2018-07-24 13:17:31', NULL, '', 'a:1:{i:0;s:9:\"ROLE_USER\";}');

-- --------------------------------------------------------

--
-- Structure de la table `ocp5_post`
--

DROP TABLE IF EXISTS `ocp5_post`;
CREATE TABLE IF NOT EXISTS `ocp5_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `postDate` datetime NOT NULL,
  `postEditDate` datetime DEFAULT NULL,
  `voteNumber` int(11) NOT NULL,
  `reports` int(11) NOT NULL,
  `story_id` int(11) NOT NULL,
  `validated` tinyint(1) NOT NULL,
  `chapter` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42E5503DAA5D4036` (`story_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ocp5_post`
--

INSERT INTO `ocp5_post` (`id`, `author`, `message`, `postDate`, `postEditDate`, `voteNumber`, `reports`, `story_id`, `validated`, `chapter`) VALUES
(25, 'Guest', 'La journée commence comme toutes les autres : les enfants sont à l’école, mon mari au bureau, et moi je m’apprête à m’asseoir devant mon ordinateur pour faire les traductions qui m’ont été demandées. J’aime traduire. J’aime écrire, jongler avec les mots et les concepts. Je me sens à l’aise dans ce travail qui me permet de rester à la maison. \r\nAu moment où je m’y attends le moins quelques images de mon rêve se faufilent entre les lignes que je suis en train de rédiger. Je m’arrête net. Mes yeux restent fixés sur l’écran mais mon attention se tourne en moi, là où le film de mon rêve défile. Immédiatement j’ouvre une nouvelle page. Mes doigts semblent taper tout seuls sur le clavier, à une vitesse dont je ne me savais pas capable.\r\nEt voilà qu’en quelques minutes un récit incroyable se crée, me laissant émerveillée :', '2018-08-24 12:06:27', NULL, 3, 0, 12, 1, 2),
(26, 'Guest', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis porta dolor in cursus. Integer vestibulum euismod vestibulum. Vestibulum volutpat ultricies eleifend. Suspendisse convallis turpis vitae augue cursus, id luctus elit hendrerit. Donec fringilla consequat ipsum, vel rutrum risus scelerisque at. In sed ultricies elit. Nulla facilisi.\r\n\r\nPraesent vitae vestibulum nisl, dapibus dapibus est. Fusce et diam vestibulum, aliquam mi vitae, tincidunt nisi. Phasellus ullamcorper arcu ligula, a vestibulum orci gravida sed. Vivamus bibendum eros vel lacus gravida fermentum. Aliquam at dolor sapien. Pellentesque tempus fermentum nisl a vestibulum. Nullam bibendum nec quam a fringilla. Nam in posuere purus. Nulla porttitor diam vel lectus pellentesque dapibus. Integer laoreet venenatis dui at aliquet. Nam luctus purus urna, ut fermentum risus vehicula ultricies.\r\n\r\nSed quam metus, auctor eu faucibus nec, fringilla non elit. In quis nunc accumsan, convallis ligula vitae, faucibus libero. Vestibulum varius magna dui, vitae sagittis turpis scelerisque quis. Interdum et malesuada fames ac ante ipsum primis in faucibus. In sagittis orci nec urna commodo, volutpat dictum magna commodo. Proin volutpat erat eu velit rutrum viverra. Vestibulum tincidunt risus hendrerit cursus ultricies. Aenean porta volutpat mauris ac ornare.', '2018-08-24 12:07:50', NULL, 0, 0, 12, 0, 2),
(27, 'Guest', 'Je suis avec mon mari. Nous marchons sur un chemin de campagne. Nous savons que nous devons nous rendre sur les collines avoisinantes pour une rencontre importante. Le paysage n’est pas comme d’habitude. Tout semble lumineux, comme éclairé de l’intérieur. Une immense paix se dégage des alentours et nous-mêmes nous nous sentons très sereins et si légers. D’ailleurs nos corps aussi sont lumineux, comme le paysage qui nous entoure.\r\nNous gravissons la colline verdoyante et découvrons une grande étendue bondée de monde. Toutes sortes de mondes. Les hommes, comme nous, sont ébahis par ce qu’ils voient. Je remarque que toutes les personnes ont leur visage éclairé par la brillance et la vitalité que dégage leur regard. Quelque chose d’incroyable a rendu tout si différent. D’étranges véhicules stationnent dans le pré et la vie grouille autour en se demandant ce qu’il se passe. La foule n’est pas formée que d’hommes, de femmes et d’enfants, il y a aussi des animaux, différents eux aussi. Différents parce qu’ils sont lumineux, comme tout le reste, et parce qu’il y a des races que je n’avais encore jamais vues. D’où viennent-ils tous ces animaux ?', '2018-08-24 12:15:21', NULL, 2, 0, 12, 1, 3),
(28, 'Guest', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis porta dolor in cursus. Integer vestibulum euismod vestibulum. Vestibulum volutpat ultricies eleifend. Suspendisse convallis turpis vitae augue cursus, id luctus elit hendrerit. Donec fringilla consequat ipsum, vel rutrum risus scelerisque at. In sed ultricies elit. Nulla facilisi.\r\n\r\nPraesent vitae vestibulum nisl, dapibus dapibus est. Fusce et diam vestibulum, aliquam mi vitae, tincidunt nisi. Phasellus ullamcorper arcu ligula, a vestibulum orci gravida sed. Vivamus bibendum eros vel lacus gravida fermentum. Aliquam at dolor sapien. Pellentesque tempus fermentum nisl a vestibulum. Nullam bibendum nec quam a fringilla. Nam in posuere purus. Nulla porttitor diam vel lectus pellentesque dapibus. Integer laoreet venenatis dui at aliquet. Nam luctus purus urna, ut fermentum risus vehicula ultricies.\r\n\r\nSed quam metus, auctor eu faucibus nec, fringilla non elit. In quis nunc accumsan, convallis ligula vitae, faucibus libero. Vestibulum varius magna dui, vitae sagittis turpis scelerisque quis. Interdum et malesuada fames ac ante ipsum primis in faucibus. In sagittis orci nec urna commodo, volutpat dictum magna commodo. Proin volutpat erat eu velit rutrum viverra. Vestibulum tincidunt risus hendrerit cursus ultricies. Aenean porta volutpat mauris ac ornare.', '2018-08-24 12:15:30', NULL, 1, 0, 12, 0, 3),
(29, 'Guest', 'Un être hors du commun sort d’un des véhicules. C’est une espèce de grand homme, très lumineux, comme un soleil. Ses rayons sont puissants et la foule murmure. Personne n’a peur. Tout le monde est intrigué et attiré par ce magnifique individu. C’est alors qu’il lève le bras et annonce que nous devons l’écouter, pendant que d’autres merveilleuses créatures sortent des autres engins et s’unissent à l’orateur.', '2018-08-24 12:16:42', NULL, 3, 0, 12, 1, 4),
(30, 'Guest', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis porta dolor in cursus. Integer vestibulum euismod vestibulum. Vestibulum volutpat ultricies eleifend. Suspendisse convallis turpis vitae augue cursus, id luctus elit hendrerit. Donec fringilla consequat ipsum, vel rutrum risus scelerisque at. In sed ultricies elit. Nulla facilisi.', '2018-08-24 12:16:52', NULL, 0, 0, 12, 0, 4),
(31, 'Guest', '-	Bonjour mes frères terriens. N’ayez crainte, je viens en paix, nous venons en paix. Votre planète s’est transformée, vous vous êtes transformés et la vie sur cette Terre prend un nouveau départ. Nous vous félicitons pour tous vos efforts au cours de tant de siècles. Vous avez su surmonter les difficultés, et vous avez réussi à vous libérer de l’illusion énorme qui couvrait votre monde. Vous avez reconnu et cultivé la flamme divine qui vous habite et qui est en réalité ce que vous êtes : votre corps n’est qu’un habit précieux qui permet à votre Etre de cheminer sur cette Terre. Vous êtes tous reliés, nous sommes tous unis par nos flammes, par notre essence…. »', '2018-08-24 12:17:37', NULL, 1, 0, 12, 1, 5),
(32, 'Guest', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed venenatis porta dolor in cursus. Integer vestibulum euismod vestibulum. Vestibulum volutpat ultricies eleifend. Suspendisse convallis turpis vitae augue cursus, id luctus elit hendrerit. Donec fringilla consequat ipsum, vel rutrum risus scelerisque at. In sed ultricies elit. Nulla facilisi.\r\n\r\nPraesent vitae vestibulum nisl, dapibus dapibus est. Fusce et diam vestibulum, aliquam mi vitae, tincidunt nisi. Phasellus ullamcorper arcu ligula, a vestibulum orci gravida sed. Vivamus bibendum eros vel lacus gravida fermentum. Aliquam at dolor sapien. Pellentesque tempus fermentum nisl a vestibulum. Nullam bibendum nec quam a fringilla. Nam in posuere purus. Nulla porttitor diam vel lectus pellentesque dapibus. Integer laoreet venenatis dui at aliquet. Nam luctus purus urna, ut fermentum risus vehicula ultricies.', '2018-08-24 12:17:45', NULL, 0, 0, 12, 0, 5),
(33, 'Guest', 'La grande entité lumineuse qui s’adresse à nous explique tout le processus que nous venons de vivre et que beaucoup n’ont pas encore réalisé. Tout s’est fait progressivement d’abord, au fil du temps terrestre, puis tout s’est accéléré et en un clin d’œil, tout s’est précipité. Comme pour un accouchement : d’abord il y a la dilatation qui prend un certain temps, puis il y a l’expulsion plus intense et plus rapide. Dans l’expulsion, la Terre a rejeté tout se qui la gênait et l’empêchait d’être la belle planète de paix et de joie qu’elle était destinée à être. En même temps, les hommes ont su expulser eux-aussi tous les souvenirs dérangeants du passé, toutes les plaies, tous les sentiments inutiles pour entreprendre une vie nouvelle dans la joie. Leur volonté de retrouver leur véritable identité leur a donné la force et le courage nécessaires pour ne plus regarder le vieux monde, celui de l’illusion. Illusion d’être le corps que nous habitons, illusion de se croire la seule planète habitée dans l’univers, illusion d’être séparés des autres vies extraterrestres et angéliques, illusion de l’existence d’un temps linéaire responsable du vieillissement… Toutes ces illusions étaient entretenues par les forces de l’ombre qui avaient intérêt à ce que l’humanité reste dans l’ignorance pour continuer à exercer leur pouvoir sur les peuples à travers des sociétés fondées sur la peur et la soumission. Les hommes ont finalement compris comment regarder en eux-mêmes, au fond de leur être pour activer la force de la vie qui s’était endormie depuis si longtemps. Maintenant la vie reprend son droit légitime de ne croître que dans la paix, la joie, l’amour à travers toute la création.', '2018-08-24 12:18:19', NULL, 2, 0, 12, 1, 6),
(34, 'Guest', 'C’est ainsi que la société s’organise d’une manière complètement différente car les hommes ont changé. Ils sont responsables d’eux-mêmes, agissent en leur âme et conscience, en parfaite harmonie avec le désir de leur cœur. Rien de ce qu’ils choisissent ne peut nuire aux autres. Les choix sont faits dans l’union de tous. La compétition, à tous les niveaux, n’a plus de raison d’être, et personne ne cherche à être meilleur que son voisin. Chacun collabore au bonheur de tous. Puisque le cœur des hommes vibre en harmonie avec tout, les pensées émises sont des pensées d’harmonie, de paix et d’amour qui créent un monde conçu par ces mêmes vibrations. C’est la loi universelle de l’attraction.', '2018-08-24 12:18:44', NULL, 1, 0, 12, 1, 7),
(35, 'Guest', 'La vie s’organise autour d’une société de collaboration où les personnes exercent un métier qui respecte leurs goûts et leurs aptitudes. Le métier n’est plus un moyen de gagner de l’argent pour vivre, mais l’expression de la vie autour d’une activité que l’on aime et qui profite à tout le monde. L’argent n’est plus vénéré ou détesté ; une nouvelle monnaie d’échange est créée et distribuée équitablement et en abondance. \r\nLes études abandonnent les matières inutiles qui rappellent l’ancien monde et introduit des matières nouvelles où sont développés les notions de collaboration, le développement des dons personnels et le respect de la faune et de la flore. On éduque les enfants à vivre dans la nature en établissant un contact réel avec les différents règnes qu’elle abrite.', '2018-08-24 12:19:08', NULL, 1, 0, 12, 1, 8),
(36, 'Guest', 'Les lois de la nouvelle physique sont montrées et expliquent les nouvelles possibilités qui s’offrent maintenant sur la Terre transformée.\r\nLa télépathie par le cœur est le premier moyen de communication de la nouvelle Terre. C’est-à-dire que ce n’est pas un contact établi intellectuellement, mais une perception ressentie spontanément au niveau du cœur, aussi bien entre les hommes, qu’entre les hommes et les animaux ou les plantes, et tous les êtres qui viennent d’autres planètes. D’ailleurs l’union avec tous les peuples des étoiles consent une variété immensurable de choix et d’expériences inimaginables.', '2018-08-24 12:19:34', NULL, 3, 0, 12, 1, 9),
(37, 'Guest', 'Le contact avec le « Soi divin », la propre divinité intérieure, est largement développé rendant ainsi impossible le retour aux vieilles habitudes, aux vieux instincts. L’humanité a définitivement abandonné son aspect « humain » pour embrasser de plus en plus son aspect « divin ».\r\n\r\nAlors je me vois au milieu de ce rêve regardant tout autour de moi comme Alice au pays des merveilles.\r\n« C’est drôle, je ne me souviens de rien. Que s’est-il passé ? » me dis-je.\r\nEt la personne qui se tient à côté de moi ayant perçu ma pensée, répond :\r\n-	Tu fais partie de l’humanité. Tu as voulu ce nouveau monde. Tout ce que nous pensons se réalise tôt ou tard. L’union de toutes nos pensées de vie sereine, en harmonie avec notre divinité intérieure, a permis à la Terre d’effectuer sa transformation, a permis aux hommes d’effectuer leur transformation. Il n’y a plus de place pour l’ancien. L’Amour a le pouvoir de tout changer. Tout est possible Ici et Maintenant. Voilà la clef. »', '2018-08-24 12:20:06', NULL, 1, 0, 12, 1, 10),
(38, 'Guest', 'Je reste un instant perplexe devant les dernières lignes que je viens d’écrire. Une étrange sensation vient troubler mon plexus solaire. Une grande vague d’amour s’empare de moi et des larmes de joie débordent de mes yeux encore incrédules devant le texte tapé.\r\nJe soupire en pensant : « Dommage que ce ne soit qu’un rêve ! » \r\nAlors une voix inconnue, douce et ferme à la fois, s’impose en moi :\r\n-	Unis-toi à tes frères dans le même rêve avec joie, créez ce nouveau monde qui n’attend que vous pour se matérialiser. Vous êtes tous intimement concernés par la création du nouveau monde. Imaginez-le, rêvez-le et vivez dès maintenant dans l’état d’esprit que tout est déjà avenu. Faites émerger la divinité enfouie dans vos cœurs. Ainsi l’humanité accomplira ce pourquoi elle est venue vivre sur Terre.', '2018-08-24 12:20:28', NULL, 1, 0, 12, 1, 11),
(39, 'Guest', 'Je bégaie un instant en essayant d’obtenir plus d’explications, mais la voix s’est tue. Le silence qui s’empare de moi me semble plus profond et plus présent que jamais. Aurais-je rêvé une autre fois, les yeux ouverts cette fois ? Une douce chaleur et un courant d’amour m’inondent et mes mains dansent encore une dernière fois sur le clavier de mon ordinateur. Sur l’écran apparaissent les derniers mots :\r\n« Tu n’y crois pas, tant pis pour toi…. Crois-y pour les autres, ils ont besoin de toi ! »', '2018-08-24 12:21:11', NULL, 2, 0, 12, 1, 12),
(40, 'Guest2', 'Tour de France 2015. Le temps est magnifique. Les routes sont bordées de fleurs gigantesques à figures humaines. Leurs pétales s\'ouvrent à mon passage, et parfument d\'encouragements ce chemin que je suis depuis ce qui me semble être une vie bien menée. Je vais si vite que je ne reconnais aucun visage ; je doute également qu\'ils reconnaissent le mien. Je leur souris. Je crois que je pleure un peu. Ou peut-être n\'est-ce là que quelques gouttes de sueur. Il fait si chaud. Mon maillot me colle à la peau, me donnant la sensation de soulever des tonnes de chairs, de vêtements gorgés d\'eau, quand je me relève ou bouge quelque peu les bras.', '2018-08-24 12:41:49', NULL, 2, 0, 13, 1, 2),
(41, 'Guest2', 'La descente me donne l\'impression de glisser. L\'air me caresse le visage, et m\'aspire comme si je me tenais sur les rails d\'un toboggan gigantesque. Curieusement, je me sens en sécurité. Pas un regard en arrière. Je laisse ce que je suis derrière moi, et fonce vers ma destinée. La victoire. Quelle qu\'elle soit.\r\nJe traverse un petit bois. Sans aucun doute le dernier, tant l\'arrivée me semble proche à présent. La température y est plus agréable. Même si je ne suis plus qu\'une machine qui ne fait qu\'avancer, en équilibre sur un curieux anneau de Möbius, sur une route qui pourrait être sans fin, j\'apprécie le paysage. Ses couleurs apaisantes. Son humidité qui laisse s\'évaporer mille parfums végétales. Des senteurs qui me font grimacer, serrer des dents, tant elles me ramènent aux plaisirs réels que je m\'interdis depuis des heures. Celui de goûter à ce qui m\'entoure, de prendre le temps de vivre, d\'observer, de humer, cet univers fabuleux que je traverse comme une étoile filante. Brûlant mes calories, comme pris de panique que ma lumière se meure et que je m\'éteigne, perdant progressivement ma vitesse, pour tomber sur le bas côté, privé de forces.', '2018-08-24 12:49:26', NULL, 1, 0, 13, 1, 3),
(42, 'Guest2', 'Je sors du bois. J\'aperçois le village, au loin. La foule. Les drapeaux. La destination suprême. La fin du voyage. Celui de la souffrance, de l\'effort inhumain ; et pourtant je regrette déjà que mon voyage se termine. Quelle belle aventure ! J\'ai peur qu\'il s\'agisse de la dernière, que la vie ne m\'autorise pas une autre chance de me battre. D\'affronter mes semblables, d\'être capable de combattre la douleur, de la maîtriser pour ne faire qu\'un avec elle, pour qu\'elle devienne une force. Un élément inébranlable de ma volonté.', '2018-08-24 12:49:59', NULL, 3, 0, 13, 1, 4),
(43, 'Guest2', 'Tel un oiseau ayant trouvé sa proie, je prends mon envol. La route serpente, donnant la sensation de se tordre sur elle-même, dernier piège avant que la lutte morale ne se termine, puis je fais face à la dernière ligne droite. Je ne me retourne pas. Pour la première fois, je sens une présence derrière moi. Sur le point de me doubler. Sur ma gauche ? Sur ma droite ? J\'ai l\'impression qu\'ils sont deux, chacun attendant mon choix pour me dépasser. Je suis tenté de m\'écarter de ma trajectoire, pour leur barrer le chemin, les obliger à signaler leur présence. Mais je ne fais rien. Je les sens toutefois plus proches, plus déterminés, comme s\'il sentaient ma peur et s\'en délectaient. Leurs roues frottant contre la mienne, pour tenter de me faire tomber. Tous les coups sont permis. J\'imagine leur sourire, leur regard braqué, tout comme moi, sur la ligne d\'arrivée. Leur rage de vaincre. S\'ils n\'ont pu rattraper le premier, ils veulent me battre, me dépasser. M\'humilier, au dernier moment. Me mettre K.O., à la dernière seconde du dernier round.', '2018-08-24 12:50:26', NULL, 1, 0, 13, 1, 5),
(44, 'Guest2', 'Je repense à mon père. A la peur que j\'avais eue. J\'avais inventé une horreur indicible derrière moi, qui m\'avait fait courir comme jamais je n\'avais couru et ne courrai jamais ; qui m\'avait fait oublier la douleur, l\'envie d\'avertir mes proches du danger. Mon objectif n\'avait été alors que d\'avancer, pour sauver ma vie. Et tant pis pour celle des autres.', '2018-08-24 12:50:47', NULL, 1, 0, 13, 1, 6),
(45, 'Guest2', 'Je repense à cet instant que je n\'ai jamais oublié. A cette curieuse leçon de vie. La peur de ce qui se trouve derrière notre épaule. De ce que l\'on ne voit pas mais que l\'on imagine avec une telle certitude que l\'intangible devient réel. Et je sens alors mes jambes augmenter leur cadence. J\'entends mon cœur, pourtant épuisé, exploser dans ma poitrine. Il y a quelque chose derrière moi. Et si ce ne sont pas des coureurs, alors qu\'est-ce que cela peut bien être ?', '2018-08-24 12:51:01', NULL, 1, 0, 13, 1, 7),
(46, 'Guest2', 'J\'entends la foule. Leurs cris ne sont que des hurlements de terreur. Leurs mains ne font qu\'indiquer ce qui me poursuit, sans relâche. Une chose qui est sortie des bois, et m\'a pris en chasse. Pour me dévorer, pour m\'emmener dans sa tanière, et se repaître de mes os, de mes muscles meurtris. Elle sait que si je flanche, je ne pourrais redémarrer, déployer de nouveau mes ailes pour la fuir. Alors j\'accélère encore, totalement paniqué. Je cligne des yeux, tant la sueur coule sur mon visage. Je déglutis. Je suis assoiffé, mais il est trop tard pour boire, pour ne serait-ce penser à boire. \r\nJe traverse la ligne d\'arrivée.', '2018-08-24 12:52:07', NULL, 3, 0, 13, 1, 8),
(47, 'Guest2', 'Les hurlements n\'en finissent pas de s\'élever. Me faisant presque chuter, tant ils en deviennent insupportables. La chose est dernière moi, bien réelle. Cela ne fait plus aucun doute. Je vois la foule qui s\'écarte, réalisant que si la créature me poursuit, elle peut les blesser dans sa frustration. Dans sa rage de me voir à sa portée et de ne pas pouvoir me prendre. Une rage que je connais, tant je l\'ai digérée toutes ces fois où, une petite voix, au plus profond de mon être, me susurrait d\'abandonner. Que c\'était de la folie de vouloir continuer. Mais je ne l\'ai pas écoutée. Et le monstre ne l\'écoutera pas non plus ; il courra, bondira, muscles bandés et la gueule béante, jusqu\'à ce qu\'il atteigne sa proie.', '2018-08-24 12:52:52', NULL, 1, 0, 13, 1, 9),
(48, 'Guest2', 'La ligne d\'arrivée est loin derrière moi à présent. Mais je ne ralentis pas. Pour rien au monde je ne m\'arrêterai. Je ne suis que douleurs. Je ne suis que chair tourmentée. Ma raison ne se résume qu\'à une seule pensée : courir, encore et encore, pour vivre. Pour survivre.\r\nPour lui échapper.', '2018-08-24 13:33:54', NULL, 2, 0, 13, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `ocp5_story`
--

DROP TABLE IF EXISTS `ocp5_story`;
CREATE TABLE IF NOT EXISTS `ocp5_story` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creationDate` datetime NOT NULL,
  `postNumber` int(11) NOT NULL,
  `postLimit` int(11) NOT NULL,
  `intro` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_202FD8882B36786B` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ocp5_story`
--

INSERT INTO `ocp5_story` (`id`, `title`, `author`, `creationDate`, `postNumber`, `postLimit`, `intro`) VALUES
(12, 'Ici et Maintenant', 'Guest', '2018-08-24 12:05:59', 12, 12, 'Le réveil est difficile ce matin. J’ai la tête lourde et mes paupières se referment à chaque fois que je fais l’effort de les ouvrir. Je prends la bouteille d’eau posée sur la table de nuit et en bois quelques gorgées. C’est alors que les images d’un rêve se superposent les unes aux autres, me laissant très peu de temps pour faire la liaison entre elles. Quelques secondes où se succèdent des flashes aussi rapides que les éclats du bouquet d’un feu d’artifice. Puis, plus rien. Le vide total. Mon rêve vient juste de s’approcher de ma mémoire, par à coups, mais a fini par sombrer quelque part au fond de moi et je ne sais plus où aller le repêcher. Il est trop tard. Tant pis !\r\nRésignée, je me dirige vers la salle de bain. Je m’asperge le visage d’eau froide et savoure le bien-être que cela me procure. C’est alors que j’arrive à saisir au vol un bout de mon rêve. J’essaie de fixer les images, je ne veux plus les perdre. Mais plus j’essaie de faire émerger de moi ce qui manque, plus je m’éloigne même de ce que je venais à peine de percevoir. Dommage !'),
(13, 'Le Chemin de Croix', 'Guest2', '2018-08-24 12:41:39', 10, 10, 'Je ne sais pas depuis combien de temps je cours. Contre le temps. Contre les autres. Contre moi-même. Enfant, je me souviens m\'être enfui, soudainement pris de panique, et avoir arrêté ma course des centaines de mètres plus loin, en réalisant que la voix qui me parvenait était celle de mon père. Il avait voulu me faire peur. Il avait réussi. \r\nAujourd\'hui, je cours encore. En quelque sorte, pour ma survie. Vous ne me connaissez pas. Je n\'ai jamais rien remporté. Je n\'ai jamais rien gagné. Pas de quoi être fier. Et pourtant, je suis là. Je ne suis que douleurs, une mécanique bien huilée qui n\'est composée que d\'une paire de jambes sans cesse en mouvement, celui d\'un balancier, et deux yeux qui fixent l\'horizon avec cet ultime but d\'aller toujours plus loin. Plus encore, je suis une voix, un écho qui m\'encourage, qui me fait croire que la victoire est au bout du chemin. Parfois, elle se fait entendre, à voix haute, dans les moments les plus difficiles ; dans les montées, quand les muscles sont sur le point de se rompre. Quand je me demande pourquoi - pour qui - je fais ce chemin de croix.');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ocp5_comment`
--
ALTER TABLE `ocp5_comment`
  ADD CONSTRAINT `FK_FFD4A952AA5D4036` FOREIGN KEY (`story_id`) REFERENCES `ocp5_story` (`id`);

--
-- Contraintes pour la table `ocp5_members`
--
ALTER TABLE `ocp5_members`
  ADD CONSTRAINT `FK_2E0029C186383B10` FOREIGN KEY (`avatar_id`) REFERENCES `ocp5_avatar` (`id`);

--
-- Contraintes pour la table `ocp5_post`
--
ALTER TABLE `ocp5_post`
  ADD CONSTRAINT `FK_42E5503DAA5D4036` FOREIGN KEY (`story_id`) REFERENCES `ocp5_story` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
