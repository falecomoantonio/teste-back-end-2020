<?php

namespace App\Models;

use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\Product as ProductTransformer;

class Product extends Model implements Transformable
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = ['name','description','price','weight','thumbnail'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function setId(int $value) : int
    {
        $this->original['id'] = $value;
    }

    public function getId() : int
    {
        return $this->original['id'];
    }

    public function setName(string $name) : void
    {
        $this->original['name'] = $name;
    }

    public function getName() : string
    {
        return $this->original['name'];
    }

    public function setDescription(string $value) : void
    {
        $this->original['description'] = $value;
    }

    public function getDescription() : string
    {
        return $this->original['description'];
    }

    public function setPrice(float $value) : void
    {
        $this->original['price'] = $value;
    }

    public function getPrice() : float
    {
        return $this->original['price'];
    }

    public function setWeight(float $value) : void
    {
        $this->original['weight'] = $value;
    }

    public function getWeight() : float
    {
        return $this->original['weight'];
    }

    public function setThumbnail(string $value) : void
    {
        $this->original['thumbnail'] = $value;
    }

    public function getThumbnail() : string
    {
        return $this->original['thumbnail'];
    }

    public function getCreatedAt(string $format = "dd/mm/YYYY HH:ii:ss") : string
    {
        return $this->created_at->format($format);
    }

    public function getUpdatedAt(string $format = "dd/mm/YYYY HH:ii:ss") : string
    {
        return $this->created_at->format($format);
    }

    public function getDeletedAt(string $format = "dd/mm/YYYY HH:ii:ss") : string
    {
        return $this->deleted_at->format($format);
    }

    public function transformer()
    {
        return ProductTransformer::class;
    }
}
