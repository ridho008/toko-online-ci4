<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $register = [
		'username' => [
			'rules' => 'required|min_length[5]'
		],
		'password' => [
			'rules' => 'required'
		],
		'repeatPassword' => [
			'rules' => 'required|matches[password]'
		]
	];

	public $register_errors = [
		'username' => [
			'required' => '{field} Harus Di isi.',
			'min_length' => '{field} Minimal 5 Karakter.'
		],
		'password' => [
			'required' => '{field} Harus Di isi.'
		],
		'repeatPassword' => [
			'required' => '{field} Harus Di isi.',
			'matches' => '{field} Tidak Match Dengan Password.'
		]
	];

	public $login = [
		'username' => [
			'rules' => 'required'
		],
		'password' => [
			'rules' => 'required'
		]
	];

	public $login_errors = [
		'username' => [
			'required' => '{field} Harus Di isi.'
		],
		'password' => [
			'required' => '{field} Harus Di isi.'
		]
	];

	public $barang = [
		'nama' => [
			'rules' => 'required|min_length[3]'
		],
		'harga' => [
			'rules' => 'required|is_natural'
		],
		'stok' => [
			'rules' => 'required|is_natural'
		],
		'gambar' => [
			'rules' => 'uploaded[gambar]'
		]
	];

	public $barang_errors = [
		'nama' => [
			'required' => '{field} Harus Di isi.'
		],
		'harga' => [
			'required' => '{field} Harus Di isi.',
			'is_natural' => '{field} Tidak Boleh Negatif.'
		],
		'stok' => [
			'required' => '{field} Harus Di isi.',
			'is_natural' => '{field} Tidak Boleh Negatif.'
		],
		'gambar' => [
			'uploaded' => '{field} Harus Di Upload.'
		]
	];

	public $barangupdate = [
		'nama' => [
			'rules' => 'required|min_length[3]'
		],
		'harga' => [
			'rules' => 'required|is_natural'
		],
		'stok' => [
			'rules' => 'required|is_natural'
		]
	];

	public $barangupdate_errors = [
		'nama' => [
			'required' => '{field} Harus Di isi.'
		],
		'harga' => [
			'required' => '{field} Harus Di isi.',
			'is_natural' => '{field} Tidak Boleh Negatif.'
		],
		'stok' => [
			'required' => '{field} Harus Di isi.',
			'is_natural' => '{field} Tidak Boleh Negatif.'
		]
	];

	public $transaksi = [
		'id_barang' => [
			'rules' => 'required'
		],
		'id_pembeli' => [
			'rules' => 'required'
		],
		'jumlah' => [
			'rules' => 'required'
		],
		'total_harga' => [
			'rules' => 'required'
		],
		'alamat' => [
			'rules' => 'required'
		],
		'ongkir' => [
			'rules' => 'required'
		]
	];
}
