<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917065242 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE price_room DROP FOREIGN KEY FK_FCDA32154177093');
        $this->addSql('CREATE TABLE coworking (id INT AUTO_INCREMENT NOT NULL, price_id INT DEFAULT NULL, adherent TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_5ADAC922D614C7E7 (price_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coworking ADD CONSTRAINT FK_5ADAC922D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id)');
        $this->addSql('DROP TABLE price_room');
        $this->addSql('DROP TABLE room');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE price_room (price_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_FCDA321D614C7E7 (price_id), INDEX IDX_FCDA32154177093 (room_id), PRIMARY KEY(price_id, room_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, room VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE price_room ADD CONSTRAINT FK_FCDA32154177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE price_room ADD CONSTRAINT FK_FCDA321D614C7E7 FOREIGN KEY (price_id) REFERENCES price (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE coworking');
    }
}
