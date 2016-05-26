import java.util.ArrayList;
import java.util.List;

import java.security.SecureRandom;

import java.util.Set;
import java.util.HashSet;

import java.util.Map;
import java.util.HashMap;

public class Foodie {

	public static final String INSERT_QUERY = "INSERT INTO %s VALUES (%s);\n";

	static List<User> users = new ArrayList<>();
	static List<Kasir> kasirs = new ArrayList<>();
	static List<Chef> chefs = new ArrayList<>();
	static List<Staf> stafs = new ArrayList<>();
	static List<Supplier> suppliers = new ArrayList<>();
	static List<BahanBaku> bahanbakus = new ArrayList<>();
	static List<ModePembayaran> modepembayarans = new ArrayList<>();
	static List<Kategori> kategoris = new ArrayList<>();
	static List<Pembelian> pembelians = new ArrayList<>();
	static List<Pemesanan> pemesanans = new ArrayList<>();
	static List<Menu> menus = new ArrayList<>();
	static List<MenuHarian> menuharians = new ArrayList<>();
	static List<PemesananMenuHarian> pemesananmenuharians = new ArrayList<>();
	static List<Konversi> konversis = new ArrayList<>();
	static List<KonversiBahanBaku> konversibahanbakus = new ArrayList<>();
	static List<BahanBakuMenu> bahanbakumenus = new ArrayList<>();
	static List<PembelianBahanBaku> pembelianbahanbakus = new ArrayList<>();
	
	static Map<String,Menu> menuMap = new HashMap<>();
	
	public static void main (String[] args) {
		// CREATE ENTRIES
		createUsers(); //USER, USER_TELEPON, KASIR, CHEF, STAF (5)
		createModePembayaran(); //MODE_PEMBAYARAN
		createKategori(); //KATEGORI
		createBahanBaku(50); //BAHAN_BAKU
		createSuppliers(50); //SUPPLIER, SUPPLIER_TELEPON (2)		
		createPembelian(250); 
		createMenu(50);
		createKonversi(25);
		createKonversiBahanBaku(75);
		createBahanBakuMenu(300);
		createPembelianBahanBaku(300);
		createPemesanan(250);
		createMenuHarian(200);
		createPemesananMenuHarian(350);
		
		System.out.println("SET search_path TO FOODIE;");
		
		outputUsers();
		outputModePembayaran();
		outputKategori();
		outputBahanBaku();
		outputSuppliers();
		outputPembelian();
		outputMenu();
		outputKonversi();
		outputKonversiBahanBaku();
		outputBahanBakuMenu();
		outputPembelianBahanBaku();
		outputPemesanan();
		outputMenuHarian();
		outputPemesananMenuHarian();
	}

	/**
	 * USER ok
	 * USER_TELEPON ok
	 * KASIR ok
	 * CHEF ok
	 * STAF ok
	 * PEMBELIAN ok
	 * PEMESANAN ok
	 * MODE_PEMBAYARAN ok
	 * MENU ok
	 * MENU_HARIAN ok
	 * PEMESANAN_MENU_HARIAN ok
	 * KATEGORI ok
	 * BAHAN_BAKU ok
	 * KONVERSI 
	 * KONVERSI_BAHAN_BAKU 
	 * BAHAN_BAKU_MENU 
	 * PEMBELIAN_BAHAN_BAKU 
	 * SUPPLIER ok
	 * SUPPLIER_TELEPON ok
	*/

	// CREATE ENTRIES SECTION
	public static void createUsers() {
		String[] roles = new String[] {"MG", "ST", "KS", "CH"};
		// Set containing user names
		Set<String> userSet = new HashSet<>();
		// for (int i = 0; i < nums; i++) {
		while (users.size() < 65 || kasirs.size() < 20 || chefs.size() < 20 || stafs.size() < 20) {
			User u = new User();
			String[] n  = RandomGenerator.randomName();
			// Repeat randomization until unique name is obtained
			while (userSet.contains(n[0] + " " + n[1])) {
				n  = RandomGenerator.randomName();
			}
			// Add new name to set
			userSet.add(n[0] + " " + n[1]);
			u.email = (n[0] + "." + n[1] + "@" + RandomGenerator.randomChar() + "mail.com").toLowerCase();
			u.nama  = n[0] + " " + n[1];
			u.alamat = "jl. " + RandomGenerator.whatever() + " No. " + RandomGenerator.randomInteger(50);
			u.password = RandomGenerator.whatever() + RandomGenerator.randomInteger(1000);
			int roleInt = RandomGenerator.randomInteger(4);
			if (roleInt == 0) {
				u.role = roles[roleInt];
			} else if (roleInt == 1) {
				u.role = roles[roleInt];
				createStafs(u);
			} else if (roleInt == 2) {
				u.role = roles[roleInt];
				createKasirs(u);
			} else if (roleInt == 3) {
				u.role = roles[roleInt];
				createChefs(u);
			}
			for(int ii = 0; ii < RandomGenerator.randomInteger(3); ii++) {
				String telp = "0";
				for (int jumlahDigit = 0; jumlahDigit < 11; jumlahDigit++)
					telp += RandomGenerator.randomInteger(10);
				u.phones.add(telp);
			}
			users.add(u);
		}
	} 

	public static void createKasirs(User u) {
		Kasir k = new Kasir();
		k.email = u.email;
		k.rating = RandomGenerator.randomInteger(5) + "." + RandomGenerator.randomInteger(10);
		k.jumlah_rating = RandomGenerator.randomInteger(50) + "";
		kasirs.add(k);
	}

	public static void createChefs(User u) {
		Chef k = new Chef();
		k.email = u.email;
		k.sertifikasi = RandomGenerator.randomInteger(5) + 1 + "";
		chefs.add(k);
	}

	public static void createStafs(User u) {
		Staf k = new Staf();
		k.email = u.email;
		k.jam_terbang = RandomGenerator.randomInteger(100) + 1 + "";
		stafs.add(k);
	}

	public static void createSuppliers(int nums) {
		// Set containing supplier names
		Set<String> supplierSet = new HashSet<>();
		while (suppliers.size() < nums) {
			Supplier s = new Supplier();
			String[] n  = RandomGenerator.randomName();
			n[1] = RandomGenerator.whatever();
			// Repeat randomization until unique name is earned
			while (supplierSet.contains(n[0] + " " + n[1])) {
				n  = RandomGenerator.randomName();
				n[1] = RandomGenerator.whatever();
			}
			// Add new name to set
			supplierSet.add(n[0] + " " + n[1]);
			s.nama = n[0] + " " + n[1];
			s.alamat = "jl. " + RandomGenerator.whatever() + " No. " + RandomGenerator.randomInteger(50);
			s.email = (n[0] + "." + n[1] + "@" + RandomGenerator.randomChar() + "mail.com").toLowerCase();

			for(int ii = 0; ii < RandomGenerator.randomInteger(3); ii++) {
				String telp = "0";
				for (int jumlahDigit = 0; jumlahDigit < 11; jumlahDigit++)
					telp += RandomGenerator.randomInteger(10);
				s.telepons.add(telp);
			}

			suppliers.add(s);
		}
	}

	public static void createBahanBaku(int nums) {
		Set<String> ingredientSet = new HashSet<>();
		while (bahanbakus.size() < nums) {
			BahanBaku s = new BahanBaku();
			s.nama = RandomGenerator.ingredient() + "y " + RandomGenerator.ingredient();
			// Repeat randomization until unique name is earned
			while (ingredientSet.contains(s.nama)) {
				s.nama = RandomGenerator.ingredient() + "y " + RandomGenerator.ingredient();
			}
			// Add new name to set
			ingredientSet.add(s.nama);
			
			// Stock unit always in kg
			s.satuanStok = "kg";
			// Assume initial stock lies in range [100,250]
			s.stok = RandomGenerator.randomInteger(151) + 120;

			s.pricePerKg = (RandomGenerator.randomInteger(20) + 15) * 1000;
			
			bahanbakus.add(s);
		}
	}

	public static void createKategori() {
		String[] cats = new String[] {"FO", "BE", "SN", "DE"};
		String[] names = new String[] {"makanan", "minuman", "snack", "dessert"};
		for(int i = 0; i < 4; i++) {
			Kategori k = new Kategori();
			k.kode = cats[i];
			k.nama = names[i];
			kategoris.add(k);
		}
	}

	public static void createModePembayaran() {
		String[] cats = new String[] {"TU", "DE", "KR"};
		String[] names = new String[] {"tunai", "debit", "kredit"};
		for(int i = 0; i < 3; i++) {
			ModePembayaran mp = new ModePembayaran();
			mp.kode = cats[i];
			mp.nama = names[i];
			modepembayarans.add(mp);
		}
	}

	public static void createPembelian (int nums) {
		int i = 0;
		while(pembelians.size() < nums) {
			Pembelian p = new Pembelian();
			p.no_nota = String.format("pb%04d", i++);
			// Purchase must be done before May 2015th (avoiding inconsistency with orders)
			do {
				p.waktu = RandomGenerator.randomDate();
			} while (p.waktu.substring(0,7).compareTo("2015-05") > 0);
			p.nama_supplier = suppliers.get(RandomGenerator.randomInteger(suppliers.size())).nama;
			p.email_staff = stafs.get(RandomGenerator.randomInteger(stafs.size())).email;
			p.pembelianBahanBakuTerlibat = 0;
			pembelians.add(p);
		}
	}

	public static void createPemesanan (int nums) {
		int i = 0;
		while(pemesanans.size() < nums) { 
			Pemesanan p = new Pemesanan();
			p.no_nota = String.format("ps%04d", i++);
			// Order must be made after May 2015th (avoiding inconsistency with purchases)
			do {
				p.waktu_pesan = RandomGenerator.randomDate();
			} while (p.waktu_pesan.substring(0,7).compareTo("2015-05") <= 0);
			do {
				p.waktu_bayar = RandomGenerator.randomDate();
			} while (p.waktu_pesan.compareTo(p.waktu_bayar) > 0);
			p.total = 0;
			p.pemesananMenuTerlibat = 0;
			p.email_kasir = kasirs.get(RandomGenerator.randomInteger(kasirs.size())).email;
			p.mode_pembayaran = modepembayarans.get(RandomGenerator.randomInteger(modepembayarans.size())).kode;
			pemesanans.add(p);
		}
	}

	public static void createMenu (int nums) {
		Set<String> menuSet = new HashSet<>();
		while(menus.size() < nums) {
			Menu m = new Menu();
			m.nama = (RandomGenerator.randomInteger(2) < 1) ? RandomGenerator.foodname() : RandomGenerator.drinkname();
			// Repeat randomization until unique name is earned
			while (menuSet.contains(m.nama)) {
				m.nama = (RandomGenerator.randomInteger(2) < 1) ? RandomGenerator.foodname() : RandomGenerator.drinkname();
			}
			// Add new name to set
			menuSet.add(m.nama);
			// Add menu to map by name
			menuMap.put(m.nama,m);
			m.deskripsi = m.nama + " created with " + RandomGenerator.ingredient() + " tasted very " + RandomGenerator.chara();
			m.gambar = m.nama.split(" ")[0] + "_" + m.nama.split(" ")[1] + ".jpg";
			m.harga = (RandomGenerator.randomInteger(50) + 1) * 1000;
			m.jumlah_tersedia = RandomGenerator.randomInteger(101) + 40;
			m.kategori = kategoris.get(RandomGenerator.randomInteger(kategoris.size())).kode;
			menus.add(m);
		}
	}

	public static void createMenuHarian (int nums) {
		while (menuharians.size() < nums) {
			MenuHarian mh = new MenuHarian();
			mh.namaMenu = menus.get(RandomGenerator.randomInteger(menus.size())).nama;
			mh.waktu = RandomGenerator.randomDate();
			mh.jumlah = RandomGenerator.randomInteger(30) + 6;
			mh.email_chef = chefs.get(RandomGenerator.randomInteger(chefs.size())).email;
			menuharians.add(mh);
		}
	}

	public static void createPemesananMenuHarian(int nums) {
		Set<String> pemesananMenuHarianSet = new HashSet<>();
		while (pemesananmenuharians.size() < nums || existOrderWithoutMenuOrder()) {
			PemesananMenuHarian pmh = new PemesananMenuHarian();
			Pemesanan p = pemesanans.get(RandomGenerator.randomInteger(pemesanans.size()));
			MenuHarian mh = menuharians.get(RandomGenerator.randomInteger(menuharians.size()));
			Menu m = menuMap.get(mh.namaMenu);
			while (pemesananMenuHarianSet.contains(p.no_nota + "|" + mh.namaMenu + "|" + mh.waktu)) {
				p = pemesanans.get(RandomGenerator.randomInteger(pemesanans.size()));
				mh = menuharians.get(RandomGenerator.randomInteger(menuharians.size()));
			}
			pemesananMenuHarianSet.add(p.no_nota + "|" + mh.namaMenu + "|" + mh.waktu);
			pmh.nomorNota = p.no_nota;
			pmh.namaMenu = mh.namaMenu;
			pmh.waktu = mh.waktu;
			pmh.jumlah = RandomGenerator.randomInteger(5) + 1;
			pemesananmenuharians.add(pmh);
			m = menuMap.get(mh.namaMenu);
			p.total += pmh.jumlah * m.harga;
			p.pemesananMenuTerlibat++;
		} 
	}

	public static void createKonversi(int nums) {
		String[] unitList = RandomGenerator.stockList;
		for (String satuanAwal : unitList) {
			for (String satuanAkhir : unitList) {
				konversis.add(new Konversi(satuanAwal,satuanAkhir));
			}
		}
	}

	public static void createKonversiBahanBaku(int nums) {
		for (BahanBaku b : bahanbakus) {
			for (Konversi k : konversis) {
				KonversiBahanBaku kbb = new KonversiBahanBaku();
				kbb.namaBahanBaku = b.nama;
				kbb.satuanAwal = k.satuanAwal;
				kbb.satuanAkhir = k.satuanAkhir;
				
				if ((kbb.satuanAwal).equals(kbb.satuanAkhir)) {
					kbb.besaranAwal = 1 + "";
					kbb.besaranAkhir = 1 + "";
				}
				else if ((kbb.satuanAwal).equals("gram")) {
					switch (kbb.satuanAkhir) {
						case "kg"   : kbb.besaranAwal = 1000 + ""; kbb.besaranAkhir = 1 + "";    break;
						case "hg"   : kbb.besaranAwal = 100 + ""; kbb.besaranAkhir = 1 + ""; break;
						case "oz"   : kbb.besaranAwal = 2835 + ""; kbb.besaranAkhir = 100 + ""; break;
						case "lbs"  : kbb.besaranAwal = 4536 + ""; kbb.besaranAkhir = 10 + ""; break;
					}
				}
				else if ((kbb.satuanAwal).equals("kg")) {
					switch (kbb.satuanAkhir) {
						case "gram" : kbb.besaranAwal = 1 + ""; kbb.besaranAkhir = 1000 + ""; break;
						case "hg"   : kbb.besaranAwal = 1 + ""; kbb.besaranAkhir = 10 + ""; break;
						case "oz"   : kbb.besaranAwal = 500 + ""; kbb.besaranAkhir = 17637 + ""; break;
						case "lbs"  : kbb.besaranAwal = 5 + ""; kbb.besaranAkhir = 11 + ""; break;
					}
				}
				else if ((kbb.satuanAwal).equals("oz")) {
					switch (kbb.satuanAkhir) {
						case "gram" : kbb.besaranAwal = 100 + ""; kbb.besaranAkhir = 2835 + ""; break;
						case "hg"   : kbb.besaranAwal = 17637 + ""; kbb.besaranAkhir = 5000 + ""; break;
						case "kg"   : kbb.besaranAwal = 17637 + ""; kbb.besaranAkhir = 500 + ""; break;
						case "lbs"  : kbb.besaranAwal = 16 + ""; kbb.besaranAkhir = 1 + ""; break;
					}
				}
				else if ((kbb.satuanAwal).equals("lbs")) {
					switch (kbb.satuanAkhir) {
						case "gram" : kbb.besaranAwal = 10 + ""; kbb.besaranAkhir = 4536 + ""; break;
						case "hg"   : kbb.besaranAwal = 11 + ""; kbb.besaranAkhir = 50 + ""; break;
						case "kg"   : kbb.besaranAwal = 11 + ""; kbb.besaranAkhir = 5 + ""; break;
						case "oz"   : kbb.besaranAwal = 1 + ""; kbb.besaranAkhir = 16 + ""; break;
					}
				}
				else if ((kbb.satuanAwal).equals("hg")) {
					switch (kbb.satuanAkhir) {
						case "gram" : kbb.besaranAwal = 1 + ""; kbb.besaranAkhir = 100 + ""; break;
						case "kg"   : kbb.besaranAwal = 10 + ""; kbb.besaranAkhir = 1 + ""; break;
						case "oz"   : kbb.besaranAwal = 5000 + ""; kbb.besaranAkhir = 17637 + ""; break;
						case "lbs"  : kbb.besaranAwal = 50 + ""; kbb.besaranAkhir = 11 + ""; break;
					}
				}
				konversibahanbakus.add(kbb);
			}
		}
	}

	public static void createBahanBakuMenu(int nums) {
		Set<String> bahanBakuMenuSet = new HashSet<>();
		while(bahanbakumenus.size() < nums) {
			BahanBakuMenu b = new BahanBakuMenu();
			BahanBaku bahanbaku = bahanbakus.get(RandomGenerator.randomInteger(bahanbakus.size()));
			Menu menu = menus.get(RandomGenerator.randomInteger(menus.size()));
			while (bahanBakuMenuSet.contains(bahanbaku.nama + "|" + menu.nama)) {
				bahanbaku = bahanbakus.get(RandomGenerator.randomInteger(bahanbakus.size()));
				menu = menus.get(RandomGenerator.randomInteger(menus.size()));
			}
			bahanBakuMenuSet.add(bahanbaku.nama + "|" + menu.nama);
			b.namaBahanBaku = bahanbaku.nama;
			b.namaMenu = menu.nama;
			
			b.satuan = RandomGenerator.stock();
			
			if (b.satuan.equals("kg") || b.satuan.equals("hg") || b.satuan.equals("lbs")) {
				b.besaran = (RandomGenerator.randomInteger(1) + 1) + "";
			}
			else {
				b.besaran = (RandomGenerator.randomInteger(10) + 1) + "";
			}
			

			bahanbakumenus.add(b);
		}
	}

	public static void createPembelianBahanBaku(int nums) {
		Set<String> pembelianBahanBakuSet = new HashSet<>();
		while(pembelianbahanbakus.size() < nums || existPurchaseWithoutIngredientPurchase()) {
			PembelianBahanBaku b = new PembelianBahanBaku();
			BahanBaku bahanbaku = bahanbakus.get(RandomGenerator.randomInteger(bahanbakus.size()));
			Pembelian pembelian = pembelians.get(RandomGenerator.randomInteger(pembelians.size()));
			
			while (pembelianBahanBakuSet.contains(bahanbaku.nama + "|" + pembelian.no_nota)){
				bahanbaku = bahanbakus.get(RandomGenerator.randomInteger(bahanbakus.size()));
				pembelian = pembelians.get(RandomGenerator.randomInteger(pembelians.size()));
			}
			pembelianBahanBakuSet.add(bahanbaku.nama + "|" + pembelian.no_nota);
			b.namaBahanBaku = bahanbaku.nama;
			b.notaPembelian = pembelian.no_nota;
			
			b.satuanPembelian = RandomGenerator.stock();
			
			if (b.satuanPembelian.equals("kg") || b.satuanPembelian.equals("lbs") || b.satuanPembelian.equals("hg")) {
				b.jumlahPembelian = RandomGenerator.randomInteger(30) + 6;
			}
			else {
				b.jumlahPembelian = RandomGenerator.randomInteger(200) + 51;
			}
			
			// Determine price per unit (from pricePerKg attribute, then convert to the purchase unit)
			b.hargaSatuan = bahanbaku.pricePerKg;
			switch (b.satuanPembelian) {
				case "kg"  : b.hargaSatuan *= 1;   b.hargaSatuan /= 1;     break;
				case "hg"  : b.hargaSatuan *= 1;   b.hargaSatuan /= 10;    break;
				case "gram": b.hargaSatuan *= 1;   b.hargaSatuan /= 1000;  break;
				case "oz"  : b.hargaSatuan *= 500; b.hargaSatuan /= 17637; break;
				case "lbs" : b.hargaSatuan *= 5;   b.hargaSatuan /= 11;    break;
			}
			pembelian.pembelianBahanBakuTerlibat++;
			pembelianbahanbakus.add(b);		
		}
	}
	
	// OUTPUT ENTRIES SECTION
	public static void outputUsers() {
		System.out.println("\n--USERS");
		// Default users, group members
		System.out.println("INSERT INTO USERS VALUES ('adam.jordan@gmail.com','Adam Jordan','jl. D03 No. 1','adamjordan','MG');");
		System.out.println("INSERT INTO USERS VALUES ('geraldo@gmail.com','Geraldo','jl. D03 No. 2','geraldo','KS');");
		System.out.println("INSERT INTO USERS VALUES ('falah.prasetyo@gmail.com','Falah Prasetyo','jl. D03 No. 3','falahprasetyo','CH');");
		System.out.println("INSERT INTO USERS VALUES ('muhammad.zaky@gmail.com','Muhammad Zaky','jl. D03 No. 4','muhammadzaky','ST');");
		for (User u : users) {
			String values = "'" + u.email + "','" + u.nama + "','" + u.alamat + "','" + u.password + "','" + u.role + "'";
			System.out.printf(INSERT_QUERY, "USERS", values);
		}
		System.out.println("\n--USER_TELEPON");
		// Phone number for default users, (not actual number)
		System.out.println("INSERT INTO USER_TELEPON VALUES ('adam.jordan@gmail.com','064926583754');");
		System.out.println("INSERT INTO USER_TELEPON VALUES ('geraldo@gmail.com','075193739104');");
		System.out.println("INSERT INTO USER_TELEPON VALUES ('falah.prasetyo@gmail.com','015295730204');");
		System.out.println("INSERT INTO USER_TELEPON VALUES ('muhammad.zaky@gmail.com','059103752849');");
		for (User u : users) {
			for (String p : u.phones) {
				String values = "'" + u.email + "','" + p + "'";
				System.out.printf(INSERT_QUERY, "USER_TELEPON", values);
			}
		}
		System.out.println("\n--KASIR");
		System.out.println("INSERT INTO KASIR VALUES ('geraldo@gmail.com',5,200);");
		for (Kasir k : kasirs) {
			String values = "'" + k.email + "'," + k.rating + "," + k.jumlah_rating + "";
			System.out.printf(INSERT_QUERY, "KASIR", values);
		}
		System.out.println("\n--CHEF");
		System.out.println("INSERT INTO CHEF VALUES ('falah.prasetyo@gmail.com',5);");
		for (Chef k : chefs) {
			String values = "'" + k.email + "'," + k.sertifikasi + "";
			System.out.printf(INSERT_QUERY, "CHEF", values);
		}
		System.out.println("\n--STAF");
		System.out.println("INSERT INTO STAF VALUES ('muhammad.zaky@gmail.com',200);");
		for (Staf k : stafs) {
			String values = "'" + k.email + "'," + k.jam_terbang + "";
			System.out.printf(INSERT_QUERY, "STAF", values);
		}
	}
	
	public static void outputModePembayaran(){
		System.out.println("\n--MODE_PEMBAYARAN");
		for (ModePembayaran s : modepembayarans) {
			String values = "'" + s.kode + "','" + s.nama + "'";
			System.out.printf(INSERT_QUERY, "MODE_PEMBAYARAN", values);
		}
	}
	
	public static void outputKategori(){
		System.out.println("\n--KATEGORI");
		for (Kategori s : kategoris) {
			String values = "'" + s.kode + "','" + s.nama + "'";
			System.out.printf(INSERT_QUERY, "KATEGORI", values);
		}
	}
	
	public static void outputBahanBaku(){
		System.out.println("\n--BAHAN_BAKU");
		for (BahanBaku s : bahanbakus) {
			String values = "'" + s.nama + "','" + s.satuanStok + "'," + s.stok + "";
			System.out.printf(INSERT_QUERY, "BAHAN_BAKU", values);
		}
	}
	
	public static void outputSuppliers(){
		System.out.println("\n--SUPPLIER");
		for (Supplier s : suppliers) {
			String values = "'" + s.nama + "','" + s.alamat + "','" + s.email + "'";
			System.out.printf(INSERT_QUERY, "SUPPLIER", values);
		}

		System.out.println("\n--SUPPLIER_TELEPON");
		for (Supplier s : suppliers) {
			for (String p : s.telepons) {
			String values = "'" + s.nama + "','" + p + "'";
			System.out.printf(INSERT_QUERY, "SUPPLIER_TELEPON", values);
			}
		}
	}
	
	public static void outputPembelian(){
		System.out.println("\n--PEMBELIAN");
		for (Pembelian p : pembelians) {
			String values = "'" + p.no_nota + "','" + p.waktu + "','" + p.nama_supplier + "','" + p.email_staff + "'";
			System.out.printf(INSERT_QUERY, "PEMBELIAN", values);
		}
	}
	
	public static void outputPemesanan(){
		System.out.println("\n--PEMESANAN");
		for (Pemesanan p : pemesanans) {
			String values = "'" + p.no_nota + "','" + p.waktu_pesan + "','" + p.waktu_bayar 
					+ "'," + p.total + ",'" + p.email_kasir + "','" + p.mode_pembayaran + "'";
			System.out.printf(INSERT_QUERY, "PEMESANAN", values);
		}
	}
	
	public static void outputMenu() {
		System.out.println("\n--MENU");
		for (Menu m : menus) {
			String values = "'" + m.nama + "','" + m.deskripsi + "','" + m.gambar + "'," + 
							m.harga + "," + m.jumlah_tersedia + ",'" + m.kategori + "'";
			System.out.printf(INSERT_QUERY, "MENU", values);			
		}
	}
	
	public static void outputMenuHarian() {
		System.out.println("\n--MENU_HARIAN");
		for (MenuHarian m : menuharians) {
			String values = "'" + m.namaMenu + "','" + m.waktu + "'," + m.jumlah + ",'" + 
							m.email_chef + "'";
			System.out.printf(INSERT_QUERY, "MENU_HARIAN", values);			
		}
	}
	
	public static void outputPemesananMenuHarian() {
		System.out.println("\n--PEMESANAN_MENU_HARIAN");
		for (PemesananMenuHarian m : pemesananmenuharians) {
			String values = "'" + m.nomorNota + "','" + m.namaMenu + "','" + m.waktu + "'," + m.jumlah + "";
			System.out.printf(INSERT_QUERY, "PEMESANAN_MENU_HARIAN", values);			
		}
	}
	
	public static void outputKonversi() {
		System.out.println("\n--KONVERSI");
		for (Konversi m : konversis) {
			String values = "'" + m.satuanAwal + "','" + m.satuanAkhir + "'";
			System.out.printf(INSERT_QUERY, "KONVERSI", values);			
		}
	}
	
	public static void outputKonversiBahanBaku() {
		System.out.println("\n--KONVERSI_BAHAN_BAKU");
		for (KonversiBahanBaku m : konversibahanbakus) {
			String values = "'" + m.namaBahanBaku + "','" + m.satuanAwal + "','" + m.satuanAkhir + "'," 
							+ m.besaranAwal + "," + m.besaranAkhir + "";
			System.out.printf(INSERT_QUERY, "KONVERSI_BAHAN_BAKU", values);			
		}
	}
	
	public static void outputBahanBakuMenu() {
		System.out.println("\n--BAHAN_BAKU_MENU");
		for (BahanBakuMenu b : bahanbakumenus) {
			String values = "'" + b.namaBahanBaku + "','" + b.namaMenu + "'," + b.besaran + ",'" 
							+ b.satuan + "'";
			System.out.printf(INSERT_QUERY, "BAHAN_BAKU_MENU", values);			
		}
	}
	
	public static void outputPembelianBahanBaku() {
		System.out.println("\n--PEMBELIAN_BAHAN_BAKU");
		for (PembelianBahanBaku b : pembelianbahanbakus) {
			String values = "'" + b.namaBahanBaku + "','" + b.notaPembelian + "'," + b.jumlahPembelian + ",'" 
							+ b.satuanPembelian + "'," + b.hargaSatuan + "";
			System.out.printf(INSERT_QUERY, "PEMBELIAN_BAHAN_BAKU", values);			
		}
	}
	
	// SUPPORT METHODS
	public static boolean existOrderWithoutMenuOrder()
	{
		boolean ada = false;
		for (Pemesanan p : pemesanans) {
			ada |= (p.pemesananMenuTerlibat == 0);
		}
		return ada;
	}
	
	public static boolean existPurchaseWithoutIngredientPurchase()
	{
		boolean ada = false;
		for (Pembelian p : pembelians) {
			ada |= (p.pembelianBahanBakuTerlibat == 0);
		}
		return ada;
	}
}

class User {
	String email;
	String nama;
	String alamat;
	String password;
	String role;
	List<String> phones;

	public User() {
		phones = new ArrayList<>();
	}

}

class Kasir {
	String email;
	String rating;
	String jumlah_rating;
}

class Chef {
	String email;
	String sertifikasi;
}

class Staf {
	String email;
	String jam_terbang;
}

class Pembelian {
	String no_nota;
	String waktu;
	String nama_supplier;
	String email_staff;
	int pembelianBahanBakuTerlibat;
}

class Pemesanan {
	String no_nota;
	String waktu_pesan;
	String waktu_bayar;
	int total;
	String email_kasir;
	String mode_pembayaran;
	int pemesananMenuTerlibat;
}

class ModePembayaran {
	String kode;
	String nama;
}

class Menu {
	String nama;
	String deskripsi;
	String gambar;
	int harga;
	int jumlah_tersedia;
	String kategori;
}

class MenuHarian {
	String namaMenu, waktu; // namaMenu, waktu
	int jumlah;
	String email_chef;
}

class PemesananMenuHarian {
	String nomorNota;
	String namaMenu, waktu; //namamenu, waktu
	int jumlah;
}

class Kategori {
	String kode;
	String nama;
}

class BahanBaku {
	String nama;
	String satuanStok;
	int stok;
	int pricePerKg;
}

class Konversi {
	String satuanAwal, satuanAkhir;
	
	public Konversi(String satuanAwal, String satuanAkhir)
	{
		this.satuanAwal = satuanAwal;
		this.satuanAkhir = satuanAkhir;
	}
}

class KonversiBahanBaku {
	String namaBahanBaku, besaranAwal, besaranAkhir;
	String satuanAwal, satuanAkhir; //satuanAwal, satuanAkhir 
}

class BahanBakuMenu {
	String namaBahanBaku, namaMenu, besaran, satuan;
}

class PembelianBahanBaku {
	String namaBahanBaku, notaPembelian, satuanPembelian;
	int jumlahPembelian, hargaSatuan;
}

class Supplier {
	String nama, alamat, email;
	ArrayList<String> telepons;

	public Supplier() {
		telepons = new ArrayList<String>();
	}
}

/*
* Actually, this is some sort of database class
*
* Yeah, that's right. A database class to generate data for a database
*
* Now don't go yo dawg on me
*
* No, really
*
* Don't
*/
class RandomGenerator {

	static final String ALPHABETS = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	static SecureRandom rnd = new SecureRandom();
	static String[] nameList = new String[] {"Shondra","Olivia","Gayla","Candida","Ken","Kasie","Clora","Armanda","Sadye","Olive","Kate","Graham","Hilda","Lawanda","Idella","Thuy","Domenica","Aimee","France","Lashawna","Cheryll","Yetta","Christal","Terra","Mardell","Chas","Peggie","Oretha","Ora","Loralee","Maurine","Jason","Rossana","Sharen","Raisa","Cortney","Deane","Faye","Morgan","Molly","Demetrice","Rudy","Jorge","Jaleesa","Mable","Sybil","Joeann","Stacia","Lynn","Macy","Jack","Adam"};
	static String[] foodList = new String[] {"Burger", "Pizza", "Meat", "Sandwich", "Chicken", "Pie", "Rice", "Noodle"};
	static String[] drinkList = new String[] {"Juice", "Liquor", "Soda", "Syrup", "Cup", "Tea", "Coffee", "Milk"};
	static String[] charList = new String[] {"Fried", "Grilled", "Paradise", "Sweet", "Salty", "Hot", "Spicy", "Nice",
												"Good", "Heavenly", "Shining", "Burning", "Special", "Overpowered"
												};
	static String[] ingredientList = new String[] {"salt", "sugar", "noodle", "rice", "chili", "paprica", "potato", "fruit",
													"water", "vegetable", "leaf"};

	static String[] stockList = new String[] {"gram", "kg", "lbs", "oz", "hg"};
	
	static final int MONTH_WITH_31_DAYS = 0b101011010101;
	static final int MONTH_WITH_30_DAYS = 0b010100101000;
	
	public static String randomString( int len ){
	   StringBuilder sb = new StringBuilder( len );
	   for( int i = 0; i < len; i++ ) 
	      sb.append(ALPHABETS.charAt(rnd.nextInt(ALPHABETS.length())));
	   return sb.toString();
	}

	public static int randomInteger(int max) {
		return rnd.nextInt(max);
	}

	public static char randomChar() {
		return ALPHABETS.charAt(rnd.nextInt(ALPHABETS.length()));
	}

	public static String[] randomName() {
		String[] n = new String[2];
		n[0] = nameList[rnd.nextInt(nameList.length)];
		n[1] = nameList[rnd.nextInt(nameList.length)];		
		return n;
	}

	public static <E> E randomObject(ArrayList<E> ls) {
		return ls.get(randomInteger(ls.size()));
	}

	public static String randomElement(String[] ls) {
		return ls[rnd.nextInt(ls.length)];
	}

	public static String randomDate()
	{
		int year = rnd.nextInt(3) + 2014; // Only 2014, 2015, 2016
		int month = rnd.nextInt(12);
		int day = rnd.nextInt(31) + 1; 
		boolean validDay = false;
		validDay |= (day <= 28) && (month == 1); 							 // Day <= 28 in February
		validDay |= (day <= 29) && (month == 1) && (year == 2016);			 // Day <= 29 in February 2016 (leap year)
		validDay |= (day <= 30) && ((MONTH_WITH_30_DAYS & (1 << month)) != 0); // Day <= 30 in a month with 30 days
		validDay |= (day <= 31) && ((MONTH_WITH_31_DAYS & (1 << month)) != 0); // Day <= 31 in a month with 31 days
		while (!validDay) {
			day = rnd.nextInt(31) + 1; 
			validDay |= (day <= 28) && (month == 1); 							 // Day <= 28 in February
			validDay |= (day <= 29) && (month == 1) && (year == 2016);			 // Day <= 29 in February 2016 (leap year)
			validDay |= (day <= 30) && ((MONTH_WITH_30_DAYS & (1 << month)) != 0); // Day <= 30 in a month with 30 days
			validDay |= (day <= 31) && ((MONTH_WITH_31_DAYS & (1 << month)) != 0); // Day <= 31 in a month with 31 days
		}
		
		int hours = rnd.nextInt(24);
		int mins = rnd.nextInt(60);
		int secs = rnd.nextInt(60);
		return String.format("%04d-%02d-%02d %02d:%02d:%02d",year,month+1,day,hours,mins,secs);
	}
	
	public static String chara() {return randomElement(charList);}
	public static String food() {return randomElement(foodList);}
	public static String drink() {return randomElement(drinkList);}
	public static String stock() {return randomElement(stockList);}
	public static String ingredient() {return randomElement(ingredientList);};
	public static String foodname() {return chara() + " " + food();}
	public static String drinkname() {return chara() + " " + drink();}

	public static String whatever() {
		int a = rnd.nextInt(5);
		if (a == 0) return chara();
		if (a == 1) return food();
		if (a == 2) return drink();
		if (a == 3) return ingredient();
		return randomName()[0];
	}

}