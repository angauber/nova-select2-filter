# nova-select2-filter
A laravel nova filter that implement jquery select2

Works with both solo and multi select

![multi](screenshots/multi.png)

## Instalation

`composer require angauber/nova-select2-filter`

## Usage
Create a new filter with 

`php artisan nova:filter MyNewFilter`

Then replace it's content like so


    

    <?php
        
        	namespace App\Nova\Filters;
        
        	use Illuminate\Database\Eloquent\Builder;
        	use Illuminate\Http\Request;
        	use Angauber\NovaSelect2Filter\NovaSelect2Filter;
        
        	class ContactType extends NovaSelect2Filter
        	{
        		public $component = 'nova-select2-filter';
        
        		public function apply(Request $request, $query, $value) {
        			return $query;
        		}
        
        		public function options(Request $request) {
        			return [];
        		}
        
        		public function config() {
        			return [
        				'config' => [
							\\ Your select2 config goes here
        				];
        			];
        		}
        	}

The `$value` parameter of the `apply()` method will either be an array or an integer depending if `multiple` is set to `true` or `false` in the `config` method

The `option()` method must return an array of `key` => `value` like so `id` => `text`

The `config()` method must return an array containing select2 config parameters.
See [Select2 documentaion](https://select2.org/configuration/options-api "Select2 documentaion")

## Exemple

Let's say you want to implement a multiple selection to filter a User Model, you could do like so

        <?php
        
        	namespace App\Nova\Filters;
        
        	use Illuminate\Database\Eloquent\Builder;
        	use Illuminate\Http\Request;
        	use Angauber\NovaSelect2Filter\NovaSelect2Filter;
        
        	class ContactType extends NovaSelect2Filter
        	{
        		public $component = 'nova-select2-filter';
        
        		public function apply(Request $request, $query, $value) {
        			return $query->whereIn('users.id', $value);
        		}
        
        		public function options(Request $request) {
        			return \App\User::pluck('username', 'id');
        		}
        
        		public function config() {
        			return [
        				'config' => [
        					'multiple' => true,
        					'allowClear' => true,
        					'placeholder' => 'Choose an option',
        				];
        			];
        		}
        	}
        



