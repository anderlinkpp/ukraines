<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250622170340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE archive CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE archives ADD ishomepage TINYINT(1) NOT NULL, DROP is_homepage, CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE activation activation INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenements CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE info info LONGTEXT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE archive CHANGE description description TEXT DEFAULT NULL, CHANGE slug slug VARCHAR(255) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE archives ADD is_homepage TINYINT(1) DEFAULT NULL, DROP ishomepage, CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE activation activation TINYINT(1) DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evenements CHANGE slug slug VARCHAR(255) DEFAULT NULL, CHANGE description description TEXT DEFAULT NULL, CHANGE info info VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
