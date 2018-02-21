<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180122203204 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql(
            'CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, alt VARCHAR(255) NOT NULL, caption VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, image_size INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE image_block (id INT NOT NULL, image_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_945E138B3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE image_block ADD CONSTRAINT FK_945E138B3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)'
        );
        $this->addSql(
            'ALTER TABLE image_block ADD CONSTRAINT FK_945E138BBF396750 FOREIGN KEY (id) REFERENCES section_abstract (id) ON DELETE CASCADE'
        );
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE image_block DROP FOREIGN KEY FK_945E138B3DA5256D');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_block');
    }
}
