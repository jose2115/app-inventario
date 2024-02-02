namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Ingredient;

class IngredientImport implements ToModel
{
    public function model(array $row)
    {
        return new Ingredient([
            'name' => $row['name'],
        ]);
    }
}