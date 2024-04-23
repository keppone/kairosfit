<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240422222225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permission_room DROP FOREIGN KEY FK_2351CA3B54177093');
        $this->addSql('ALTER TABLE permission_room DROP FOREIGN KEY FK_2351CA3BFED90CCA');
        $this->addSql('DROP TABLE permission_room');
        $this->addSql('DROP TABLE permission');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B9393F8FE');
        $this->addSql('DROP INDEX IDX_729F519B9393F8FE ON room');
        $this->addSql('ALTER TABLE room ADD mailing TINYINT(1) NOT NULL, ADD planning TINYINT(1) NOT NULL, ADD promote TINYINT(1) NOT NULL, ADD sale TINYINT(1) NOT NULL, CHANGE partner_id partners_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BBDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_729F519BBDE7F1C6 ON room (partners_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permission_room (permission_id INT NOT NULL, room_id INT NOT NULL, INDEX IDX_2351CA3BFED90CCA (permission_id), INDEX IDX_2351CA3B54177093 (room_id), PRIMARY KEY(permission_id, room_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, mailing TINYINT(1) NOT NULL, planning TINYINT(1) NOT NULL, promotion TINYINT(1) NOT NULL, sale TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE permission_room ADD CONSTRAINT FK_2351CA3B54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permission_room ADD CONSTRAINT FK_2351CA3BFED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BBDE7F1C6');
        $this->addSql('DROP INDEX IDX_729F519BBDE7F1C6 ON room');
        $this->addSql('ALTER TABLE room DROP mailing, DROP planning, DROP promote, DROP sale, CHANGE partners_id partner_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_729F519B9393F8FE ON room (partner_id)');
    }
}
