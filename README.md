# flashscore

Run tests by:

```bash
docker build -t flashscore .
docker run flashscore
```

# Komentář
Běžně bych nepoužil předávání DB connectionu do entity, vhodnější by bylo načítat ho z conteineru aplikace. Stejně tak
bych asi nedovolil entitě se ukládat. To by měl obstarávat model. SQLite DB jsem dal do gitu jen pro účely snadného 
předání/testování projektu. Setery jsou private, protože podle zadání se mají hodnoty nastavovat přes konstruktor, 
normálně bych je dal public nebo protected. Návrhový vzor Builder jsem nesnal, tak snad jsem ho pochopil a použil 
správně.