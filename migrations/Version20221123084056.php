<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221123084056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, price VARCHAR(255) NOT NULL, quantity INT NOT NULL, unit_tag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D77C9783D2');
        $this->addSql('ALTER TABLE configuration DROP FOREIGN KEY FK_A5E2A5D7E308AC6F');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('ALTER TABLE printing ADD cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE printing ADD CONSTRAINT FK_308F6DF31AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_308F6DF31AD5CDBF ON printing (cart_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE printing DROP FOREIGN KEY FK_308F6DF31AD5CDBF');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, printing_id INT NOT NULL, material_id INT NOT NULL, INDEX IDX_A5E2A5D77C9783D2 (printing_id), INDEX IDX_A5E2A5D7E308AC6F (material_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D77C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
        $this->addSql('ALTER TABLE configuration ADD CONSTRAINT FK_A5E2A5D7E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP INDEX IDX_308F6DF31AD5CDBF ON printing');
        $this->addSql('ALTER TABLE printing DROP cart_id');
    }
}
