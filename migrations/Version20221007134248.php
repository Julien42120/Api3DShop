<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007134248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE cart_printing DROP FOREIGN KEY FK_AE102298E308AC6F');
        $this->addSql('ALTER TABLE cart_printing DROP FOREIGN KEY FK_AE1022987C9783D2');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_printing');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cart_printing (id INT AUTO_INCREMENT NOT NULL, printing_id INT DEFAULT NULL, material_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_AE102298E308AC6F (material_id), UNIQUE INDEX UNIQ_AE1022987C9783D2 (printing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_printing ADD CONSTRAINT FK_AE102298E308AC6F FOREIGN KEY (material_id) REFERENCES material (id)');
        $this->addSql('ALTER TABLE cart_printing ADD CONSTRAINT FK_AE1022987C9783D2 FOREIGN KEY (printing_id) REFERENCES printing (id)');
    }
}
