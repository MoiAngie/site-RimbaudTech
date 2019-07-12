<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712083740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tarifs (id INT AUTO_INCREMENT NOT NULL, loca_ce_demi_j VARCHAR(255) DEFAULT NULL, loca_ce_j VARCHAR(255) DEFAULT NULL, loca_reu_demi_j VARCHAR(255) DEFAULT NULL, loca_reu_j VARCHAR(255) DEFAULT NULL, adhesion_annee VARCHAR(255) DEFAULT NULL, co_heure_adh VARCHAR(255) DEFAULT NULL, co_heure_nonadh VARCHAR(255) DEFAULT NULL, co_demi_j_adh VARCHAR(255) DEFAULT NULL, co_demi_j_nonadh VARCHAR(255) DEFAULT NULL, co_journee_adh VARCHAR(255) DEFAULT NULL, co_journee_nonadh VARCHAR(255) DEFAULT NULL, co_mois_adh VARCHAR(255) DEFAULT NULL, co_mois_nonadh VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tarifs');
    }
}
