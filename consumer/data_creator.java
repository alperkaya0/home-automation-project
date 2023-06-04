public class data_creator {
    public static void main(String[] args) {
        createInsertionsForWeather("INSERT INTO `chart_weather` VALUES (9, \"alperkaya\", \"2023-06-02\", 11);");
    }
    public static void createInsertionsForTemperature(String s) {
        String[] arr = s.split("9|2023-06-02|11|alperkaya");
        String[] _arr = new String[]{"110", "meryemAhiskali", "2023-06-02", "11"};

        for (int j = 0; j < 100; ++j) {
            _arr[0] = (Integer.parseInt(_arr[0]) + 1) + "" ;
            _arr[2] = _arr[2].substring(0, _arr[2].length()-1) + (int)(Math.random()*9 + 1);
            _arr[3] = Integer.toString((int)(Math.random()*100));

            int k = 0;
            for (int i = 0; i < arr.length; ++i) {
                System.out.print(arr[i] + (k < _arr.length ? _arr[k++] : ""));
            }
            System.out.println();
        }
    }

    public static void createInsertionsForLightUsage(String s) {
        String[] arr = s.split("9|2023-06-02|11|alperkaya");
        String[] _arr = new String[]{"210", "alperkaya", "2023-06-02", "11"};

        for (int j = 0; j < 1000; ++j) {
            _arr[0] = (Integer.parseInt(_arr[0]) + 1) + "" ;
            String randomYear = "202";
            randomYear += (int)(Math.random()*4)+"";
            String randomMonth = (int)(Math.random()*12 + 1)+"";
            String randomDay = (int)(Math.random()*27 + 1)+"";
            if (randomDay.length() < 2) randomDay = "0" + randomDay;
            if (randomMonth.length() < 2) randomMonth = "0" + randomMonth;
            _arr[2] = randomYear+"-"+randomMonth+"-"+randomDay;
            _arr[3] = Double.toString(Math.random()*1000);

            int k = 0;
            for (int i = 0; i < arr.length; ++i) {
                System.out.print(arr[i] + (k < _arr.length ? _arr[k++] : ""));
            }
            System.out.println();
        }
    }

    public static void createInsertionsForEnergyConsumption(String s) {
        String[] arr = s.split("9|2023-06-02|11|alperkaya");
        String[] _arr = new String[]{"1000", "alperkaya", "2023-06-02", "11"};

        for (int j = 0; j < 1000; ++j) {
            _arr[0] = (Integer.parseInt(_arr[0]) + 1) + "" ;
            String randomYear = "202";
            randomYear += (int)(Math.random()*4)+"";
            String randomMonth = (int)(Math.random()*12 + 1)+"";
            String randomDay = (int)(Math.random()*27 + 1)+"";
            if (randomDay.length() < 2) randomDay = "0" + randomDay;
            if (randomMonth.length() < 2) randomMonth = "0" + randomMonth;
            _arr[2] = randomYear+"-"+randomMonth+"-"+randomDay;
            _arr[3] = Double.toString((Math.random()*1000));

            int k = 0;
            for (int i = 0; i < arr.length; ++i) {
                System.out.print(arr[i] + (k < _arr.length ? _arr[k++] : ""));
            }
            System.out.println();
        }
    }
    
    public static void createInsertionsForWeather(String s) {
        String[] arr = s.split("9|2023-06-02|11|alperkaya");
        String[] _arr = new String[]{"1000", "meryemAhiskali", "2023-06-02", "11"};
        String[] weathers = new String[]{"sunny", "rainy", "cloudy", "stormy", "windy"};

        for (int j = 0; j < 1000; ++j) {
            _arr[0] = (Integer.parseInt(_arr[0]) + 1) + "" ;
            String randomYear = "202";
            randomYear += (int)(Math.random()*4)+"";
            String randomMonth = (int)(Math.random()*12 + 1)+"";
            String randomDay = (int)(Math.random()*27 + 1)+"";
            if (randomDay.length() < 2) randomDay = "0" + randomDay;
            if (randomMonth.length() < 2) randomMonth = "0" + randomMonth;
            _arr[2] = randomYear+"-"+randomMonth+"-"+randomDay;
            _arr[3] = "\""+weathers[(int)(Math.random()*5)]+"\"";

            int k = 0;
            for (int i = 0; i < arr.length; ++i) {
                System.out.print(arr[i] + (k < _arr.length ? _arr[k++] : ""));
            }
            System.out.println();
        }
    }
}