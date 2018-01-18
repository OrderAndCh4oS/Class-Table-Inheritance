<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180117213309 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE section_abstract ADD article_id INT DEFAULT NULL');
        $this->addSql(
            'ALTER TABLE section_abstract ADD CONSTRAINT FK_E55805FD7294869C FOREIGN KEY (article_id) REFERENCES article (id)'
        );
        $this->addSql('CREATE INDEX IDX_E55805FD7294869C ON section_abstract (article_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $this->addSql('ALTER TABLE section_abstract DROP FOREIGN KEY FK_E55805FD7294869C');
        $this->addSql('DROP INDEX IDX_E55805FD7294869C ON section_abstract');
        $this->addSql('ALTER TABLE section_abstract DROP article_id');
    }
}