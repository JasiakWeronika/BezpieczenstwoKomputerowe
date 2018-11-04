package Lista4;
import java.util.*;

public class Kryptogram {
    private ArrayList<Integer> znakiKryptogramu = new ArrayList<>();
    
    public Kryptogram(String kryptogram) {
        textNaASCII(kryptogram);
    }

    private void textNaASCII(String kryptogram) {
        for (String znak : kryptogram.split(" ")) {
        	znakiKryptogramu.add(Integer.parseInt(znak, 2));
        }
    }

    public int kodASCII(int pozycja) {
        if (pozycja >= 0 && pozycja < rozmiarKryptogramu()) {
            return znakiKryptogramu.get(pozycja);
        } else {
            return 32;
        }
    }

    public int rozmiarKryptogramu() {
        return znakiKryptogramu.size();
    }
}