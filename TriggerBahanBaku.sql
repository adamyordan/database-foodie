-- Function 1: Refresh stock after purchasing ingredient
CREATE OR REPLACE FUNCTION hitung_stok_beli()
RETURNS TRIGGER AS
$$
	DECLARE
		total_purchase BIGINT;
		total_usage BIGINT;
	BEGIN
		IF (TG_OP = 'INSERT' OR TG_OP = 'UPDATE') THEN
			SELECT SUM(PBB.JumlahPembelian * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_purchase
			FROM PEMBELIAN_BAHAN_BAKU AS PBB, KONVERSI_BAHAN_BAKU AS KBB, BAHAN_BAKU AS BB
			WHERE NEW.NamaBahanBaku=PBB.NamaBahanBaku AND BB.Nama=PBB.NamaBahanBaku AND PBB.NamaBahanBaku=KBB.NamaBahanBaku AND KBB.SatuanAwal=PBB.SatuanPembelian AND BB.SatuanStok=KBB.SatuanAkhir;
			
			SELECT SUM(MH.Jumlah * BBM.Besaran * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_usage
			FROM MENU_HARIAN AS MH, BAHAN_BAKU_MENU AS BBM, BAHAN_BAKU AS BB, KONVERSI_BAHAN_BAKU AS KBB
			WHERE MH.NamaMenu=BBM.NamaMenu AND BBM.NamaBahanBaku=NEW.NamaBahanBaku AND BBM.NamaBahanBaku=BB.Nama AND BB.Nama=KBB.NamaBahanBaku AND BBM.Satuan=KBB.SatuanAwal AND BB.SatuanStok=KBB.SatuanAkhir;
			
			UPDATE BAHAN_BAKU
			SET Stok=total_purchase-total_usage
			WHERE NEW.NamaBahanBaku=Nama;
			
		ELSIF (TG_OP = 'DELETE') THEN
			SELECT SUM(PBB.JumlahPembelian * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_purchase
			FROM PEMBELIAN_BAHAN_BAKU AS PBB, KONVERSI_BAHAN_BAKU AS KBB, BAHAN_BAKU AS BB
			WHERE OLD.NamaBahanBaku=PBB.NamaBahanBaku AND BB.Nama=PBB.NamaBahanBaku AND PBB.NamaBahanBaku=KBB.NamaBahanBaku AND KBB.SatuanAwal=PBB.SatuanPembelian AND BB.SatuanStok=KBB.SatuanAkhir;
			
			SELECT SUM(MH.Jumlah * BBM.Besaran * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_usage
			FROM MENU_HARIAN AS MH, BAHAN_BAKU_MENU AS BBM, BAHAN_BAKU AS BB, KONVERSI_BAHAN_BAKU AS KBB
			WHERE MH.NamaMenu=BBM.NamaMenu AND BBM.NamaBahanBaku=OLD.NamaBahanBaku AND BBM.NamaBahanBaku=BB.Nama AND BB.Nama=KBB.NamaBahanBaku AND BBM.Satuan=KBB.SatuanAwal AND BB.SatuanStok=KBB.SatuanAkhir;
			
			UPDATE BAHAN_BAKU
			SET Stok=total_purchase-total_usage
			WHERE OLD.NamaBahanBaku=Nama;
		END IF;
		
		RETURN NEW;
	END
$$
LANGUAGE plpgsql;

-- Function 2: Refresh stock after using ingredient
CREATE OR REPLACE FUNCTION hitung_stok_pakai()
RETURNS TRIGGER AS
$$
	DECLARE
		row_data RECORD;
		total_purchase BIGINT;
		total_usage BIGINT;
	BEGIN
		IF (TG_OP = 'INSERT' OR TG_OP = 'UPDATE') THEN
			FOR row_data IN
				(SELECT *
				FROM BAHAN_BAKU_MENU AS BBM
				WHERE NEW.NamaMenu=BBM.NamaMenu)
			LOOP
				SELECT SUM(PBB.JumlahPembelian * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_purchase
				FROM PEMBELIAN_BAHAN_BAKU AS PBB, KONVERSI_BAHAN_BAKU AS KBB, BAHAN_BAKU AS BB
				WHERE row_data.NamaBahanBaku=PBB.NamaBahanBaku AND BB.Nama=PBB.NamaBahanBaku AND PBB.NamaBahanBaku=KBB.NamaBahanBaku AND KBB.SatuanAwal=PBB.SatuanPembelian AND BB.SatuanStok=KBB.SatuanAkhir;
				
				SELECT SUM(MH.Jumlah * BBM.Besaran * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_usage
				FROM MENU_HARIAN AS MH, BAHAN_BAKU_MENU AS BBM, BAHAN_BAKU AS BB, KONVERSI_BAHAN_BAKU AS KBB
				WHERE MH.NamaMenu=BBM.NamaMenu AND BBM.NamaBahanBaku=row_data.NamaBahanBaku AND BBM.NamaBahanBaku=BB.Nama AND BB.Nama=KBB.NamaBahanBaku AND BBM.Satuan=KBB.SatuanAwal AND BB.SatuanStok=KBB.SatuanAkhir;
				
				UPDATE BAHAN_BAKU
				SET Stok=total_purchase-total_usage
				WHERE row_data.NamaBahanBaku=Nama;
			END LOOP;
		ELSIF (TG_OP = 'DELETE') THEN
			FOR row_data IN
				(SELECT 
				FROM BAHAN_BAKU_MENU AS BBM
				WHERE OLD.NamaMenu=BBM.NamaMenu)
			LOOP
				SELECT SUM(PBB.JumlahPembelian * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_purchase
				FROM PEMBELIAN_BAHAN_BAKU AS PBB, KONVERSI_BAHAN_BAKU AS KBB, BAHAN_BAKU AS BB
				WHERE row_data.NamaBahanBaku=PBB.NamaBahanBaku AND BB.Nama=PBB.NamaBahanBaku AND PBB.NamaBahanBaku=KBB.NamaBahanBaku AND KBB.SatuanAwal=PBB.SatuanPembelian AND BB.SatuanStok=KBB.SatuanAkhir;
				
				SELECT SUM(MH.Jumlah * BBM.Besaran * KBB.BesaranAkhir / KBB.BesaranAwal) INTO total_usage
				FROM MENU_HARIAN AS MH, BAHAN_BAKU_MENU AS BBM, BAHAN_BAKU AS BB, KONVERSI_BAHAN_BAKU AS KBB
				WHERE MH.NamaMenu=BBM.NamaMenu AND BBM.NamaBahanBaku=row_data.NamaBahanBaku AND BBM.NamaBahanBaku=BB.Nama AND BB.Nama=KBB.NamaBahanBaku AND BBM.Satuan=KBB.SatuanAwal AND BB.SatuanStok=KBB.SatuanAkhir;
				
				UPDATE BAHAN_BAKU
				SET Stok=total_purchase-total_usage
				WHERE row_data.NamaBahanBaku=Nama;
			END LOOP;
		END IF;
		
		RETURN NEW;
	END
$$
LANGUAGE plpgsql;

-- Trigger 1: Purchasing Ingredient
CREATE TRIGGER refresh_stok_beli
AFTER INSERT OR DELETE OR UPDATE
ON PEMBELIAN_BAHAN_BAKU FOR EACH ROW
EXECUTE PROCEDURE hitung_stok_beli();

-- Trigger 2: Using ingredient
CREATE TRIGGER refresh_stok_pakai
AFTER INSERT OR DELETE OR UPDATE
ON MENU_HARIAN FOR EACH ROW
EXECUTE PROCEDURE hitung_stok_pakai();

-- Example 
INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES ('watery salt','pb0249',1,'kg',11000);
INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES ('salty sugar','pb0249',1,'kg',11000);
SELECT * FROM BAHAN_BAKU OFFSET 48;
INSERT INTO PEMBELIAN VALUES ('pb0250',CURRENT_TIMESTAMP, 'Peggie Jack', 'jack.lynn@wmail.com');
INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES ('watery salt','pb0250',1,'kg',11000);
INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES ('salty sugar','pb0250',1,'kg',11000);
SELECT * FROM BAHAN_BAKU OFFSET 48;

INSERT INTO MENU_HARIAN VALUES ('Heavenly Pizza', '2016-05-21 18:16:14', 20, 'christal.sadye@omail.com');
SELECT * FROM BAHAN_BAKU WHERE Nama='watery salt';
INSERT INTO MENU_HARIAN VALUES ('Good Soda', '2016-05-21 18:16:15', 1, 'christal.sadye@omail.com');
SELECT * FROM BAHAN_BAKU WHERE Nama='watery salt';
