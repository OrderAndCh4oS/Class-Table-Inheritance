<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180121104703 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql(
            'CREATE TABLE archive (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, page_title TINYTEXT NOT NULL, meta_description TEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE article ADD archive_id INT DEFAULT NULL');
        $this->addSql(
            'ALTER TABLE article ADD CONSTRAINT FK_23A0E662956195F FOREIGN KEY (archive_id) REFERENCES archive (id)'
        );
        $this->addSql('CREATE INDEX IDX_23A0E662956195F ON article (archive_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E662956195F');
        $this->addSql('DROP TABLE archive');
        $this->addSql('DROP INDEX IDX_23A0E662956195F ON article');
        $this->addSql('ALTER TABLE article DROP archive_id');
    }
}
