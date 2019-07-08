<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708085241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD introduction LONGTEXT DEFAULT NULL, ADD sous_titre1 VARCHAR(255) DEFAULT NULL, ADD paragraphe1 LONGTEXT DEFAULT NULL, ADD sous_titre2 VARCHAR(255) DEFAULT NULL, ADD paragraphe2 LONGTEXT DEFAULT NULL, ADD sous_titre3 VARCHAR(255) DEFAULT NULL, ADD paragraphe3 LONGTEXT DEFAULT NULL, ADD sous_titre4 VARCHAR(255) DEFAULT NULL, ADD paragraphe4 LONGTEXT DEFAULT NULL, ADD valid_until DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP introduction, DROP sous_titre1, DROP paragraphe1, DROP sous_titre2, DROP paragraphe2, DROP sous_titre3, DROP paragraphe3, DROP sous_titre4, DROP paragraphe4, DROP valid_until');
    }
}
