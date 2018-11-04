package Lista4;
import java.io.*;
import java.util.*;

public class Dekoder {
    private static ArrayList<Kryptogram> kryptogramy;
    private static ArrayList<Integer> klucze = new ArrayList<>();
    private Map<Integer, Integer> czestotliowsc;
    private char[][] znaki = {
    		{' ', 900}, {'i', 883}, {'e', 868}, {'a', 837}, {'o', 753}, 
    		{'n', 569}, {'z', 533}, {'r', 415}, {'s', 413}, {'w', 411},
    		{'y', 403}, {'c', 389}, {'t', 385}, {'d', 335}, {'k', 301},
    		{'p', 287}, {'m', 281}, {'j', 228}, {'l', 224}, {'u', 206},
    		{'b', 193}, {'g', 146}, {'h', 125}, {'f', 26}, {',', 150},
    		{'.', 100}, {'-', 50}, {'?', 20}, {'!', 10}, {'"', 6}, 
    		{':', 3}, {';', 3}, {'(', 2}, {')', 2}, {'-', 2},
    };
   
    public Dekoder(int liczba) throws IOException {
    	kryptogramy = przykladoweKryptogramy(liczba);
    	czestotliowsc = czestotliwoscWystepowaniaZnakow();
    }
    
    private ArrayList<Kryptogram> przykladoweKryptogramy(int liczba) throws IOException {
    	ArrayList<Kryptogram> kryptogramy = new ArrayList<>();
        String wiersz;
        BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(new FileInputStream("data.txt")));
        for (int i = 0; i < liczba; i++) {
        	wiersz = bufferedReader.readLine();
        	kryptogramy.add(new Kryptogram(wiersz));
		}
        return kryptogramy;
    }

    private ArrayList<Integer> mozliweKlucze() {
    	Set<Integer> przypuszczalneKlucze = new HashSet<>();
    	ArrayList<Kryptogram> aktywneKryptogramy;
        int klucz, maksimum, licznik, prawdopodobne, najbardziejPrawdopodobne, najdluzszyKryptogram = 0;
        for (Kryptogram kryptogram : kryptogramy) {
        	if (kryptogram.rozmiarKryptogramu() > najdluzszyKryptogram) {
        		najdluzszyKryptogram = kryptogram.rozmiarKryptogramu();
        	}
        }
        for (int i = 0; i < najdluzszyKryptogram; i++) {
        	aktywneKryptogramy = aktualnyKryptogram(i);
            for (Kryptogram kryptogram : aktywneKryptogramy) {
                for (int literyASCII : czestotliowsc.keySet()) {
                	przypuszczalneKlucze.add(literyASCII ^ kryptogram.kodASCII(i));
                }
            }
            klucz = 32;
            maksimum = 0;
            najbardziejPrawdopodobne = 0;
            for (int k = 0; k < przypuszczalneKlucze.size(); k++) {
            	licznik = 0;
            	prawdopodobne = 0;
                for (Kryptogram kryptogram: aktywneKryptogramy) {
                    int literyASCII = kryptogram.kodASCII(i) ^ k;
                    if (czestotliowsc.containsKey(literyASCII)) {
                    	licznik++;
                    	prawdopodobne += czestotliowsc.get(literyASCII);
                    }
                }
                if (licznik == maksimum && prawdopodobne > najbardziejPrawdopodobne) {
                	klucz = k;
                    najbardziejPrawdopodobne = prawdopodobne;
                    
                } else if (licznik > maksimum) {
                	klucz = k;
                    najbardziejPrawdopodobne = prawdopodobne;
                    maksimum = licznik;
                }
            }
            klucze.add(klucz);
        }
        return klucze;
    }

    private ArrayList<Kryptogram> aktualnyKryptogram(int pozycja) {
    	ArrayList<Kryptogram> aktywneKryptogramy = new ArrayList<>();
        for (Kryptogram kryptogram : kryptogramy) {
            if (pozycja < kryptogram.rozmiarKryptogramu()) {
            	aktywneKryptogramy.add(kryptogram);
            }
        }
        return aktywneKryptogramy;
    }

    private Map<Integer, Integer> czestotliwoscWystepowaniaZnakow() {
        HashMap<Integer, Integer> czestotliwoscZnakow = new HashMap<>();
        for (int i = 48; i < 58; i++) {
        	czestotliwoscZnakow.put(i, 10);
        }
        for (int i = 65; i <= 90; i++) {
        	czestotliwoscZnakow.put(i, 20);
        }
        for (int i = 0; i < znaki.length; i++) {
        	for (int j = 0; j < 1; j++) {
        		czestotliwoscZnakow.put((int) znaki[i][j],(int) znaki[i][j + 1]);
			}	
		}
        return czestotliwoscZnakow;
    }
    public static void main(String[] args) throws IOException {
    	Scanner scanner = new Scanner(System.in);
    	System.out.println("Podaj ilość kryptogramów jaka ma zostać wczytana:");
    	int liczba = scanner.nextInt();
    	if (liczba > 0 && liczba < 22) {
    		Dekoder dekoder = new Dekoder(liczba);
    	    dekoder.mozliweKlucze();
    	    FileWriter fileWriter = new FileWriter("telegram.txt");
    	    BufferedWriter bufferedWriter = new BufferedWriter(fileWriter);
    	    for (Kryptogram kryptogram : kryptogramy) {
    	    	for (int i = 0; i < kryptogram.rozmiarKryptogramu(); i++) {
    	    		bufferedWriter.write((char) (kryptogram.kodASCII(i) ^ klucze.get(i)));
    	        }
    	        bufferedWriter.newLine();
    	        bufferedWriter.newLine();
    	    }
    	    bufferedWriter.close();
    	    System.out.println("Rozwiązanie znajduje się w pliku telegram.txt");			
		} else {
			System.out.println("Pamiętaj o tym, że musi to być liczba całkowita z przedziału <1;21>");
		}
    }
}