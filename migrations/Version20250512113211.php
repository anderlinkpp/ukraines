<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512113211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, evenements_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, permalien VARCHAR(255) NOT NULL, courte_description VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, activation TINYINT(1) NOT NULL, creation_par VARCHAR(50) DEFAULT NULL, modification_par VARCHAR(50) DEFAULT NULL, INDEX IDX_BFDD316863C02CD4 (evenements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE articles_categories (articles_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_DE004A0E1EBAF6CC (articles_id), INDEX IDX_DE004A0EA21214B7 (categories_id), PRIMARY KEY(articles_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE articles_images (articles_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_5A276A471EBAF6CC (articles_id), INDEX IDX_5A276A47D44F05E5 (images_id), PRIMARY KEY(articles_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE articles_utilisateurs (articles_id INT NOT NULL, utilisateurs_id INT NOT NULL, INDEX IDX_736A55A71EBAF6CC (articles_id), INDEX IDX_736A55A71E969C5 (utilisateurs_id), PRIMARY KEY(articles_id, utilisateurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, permalien VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE evenements (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, lieu VARCHAR(100) DEFAULT NULL, adresse VARCHAR(100) DEFAULT NULL, ville VARCHAR(100) DEFAULT NULL, code_postal VARCHAR(10) DEFAULT NULL, activation TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, creation_par VARCHAR(50) NOT NULL, modification_par VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, texte_alternatif VARCHAR(100) NOT NULL, date_evenement DATETIME DEFAULT NULL, activation TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, creation_par VARCHAR(50) NOT NULL, modification_par VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles ADD CONSTRAINT FK_BFDD316863C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenements (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_categories ADD CONSTRAINT FK_DE004A0E1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_categories ADD CONSTRAINT FK_DE004A0EA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A471EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_images ADD CONSTRAINT FK_5A276A47D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_utilisateurs ADD CONSTRAINT FK_736A55A71EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_utilisateurs ADD CONSTRAINT FK_736A55A71E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316863C02CD4
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_categories DROP FOREIGN KEY FK_DE004A0E1EBAF6CC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_categories DROP FOREIGN KEY FK_DE004A0EA21214B7
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A471EBAF6CC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_images DROP FOREIGN KEY FK_5A276A47D44F05E5
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_utilisateurs DROP FOREIGN KEY FK_736A55A71EBAF6CC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE articles_utilisateurs DROP FOREIGN KEY FK_736A55A71E969C5
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE articles
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE articles_categories
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE articles_images
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE articles_utilisateurs
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categories
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evenements
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE images
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
