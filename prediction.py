from turtle import forward


database = {
    'Sleman':{
        'curah_hujan':150,
        'daerah_resapan':3,
        'banyak_pohon':8000,
        'kecepatan_angin':40},
    'Gunung Kidul':{
         'curah_hujan':150,
        'daerah_resapan':3,
        'banyak_pohon':8000,
        'kecepatan_angin':40},
}

Rule = {
    
}

'''
R1 : IF A >= 50 mm/hari THEN E.(hujan tinggi)
R2 : IF A < 50 mm/hari THEN F. (hujan rendah)
R3 : IF B >= 2 hektar THEN G. (daerah resapan besar)
R4 : IF B < 2 hektar THEN H. (daerah resapan sempit)
R5 : IF C >= 5000 THEN I. (jumlah pohon tinggi)
R6 : IF C < 5000 THEN J. (jumlah pohon rendah)
R7 : IF D >= 30 km/jam THEN K. (kecepatan angin tinggi)
R8 : IF D < 30 km/jam THEN L. (kecepatan angin rendah)
R9 : IF C AND D THEN M. (rawan pohon tumbang)
R10 : IF J AND K THEN M. (rawan pohon tumbang)
R11 : IF I AND L THEN N. (aman pohon tumbang)
R12 : IF J AND L THEN N. (aman pohon tumbang)
R13 : IF A AND H THEN O. (rawan banjir)
R14 : IF E AND G THEN O. (rawan banjir)
R15 : IF B AND H THEN O. (rawan banjir)
R16 : IF B AND G THEN P. (aman banjir)
R17 : IF O AND M THEN X. (daerah berbahaya)
R18 : IF O AND N THEN X. (daerah berbahaya)
R19 : IF P AND M THEN X. (daerah berbahaya)
R20 : IF P AND N THEN Y. (daerah aman)
'''

class Rule:
    def __init__(self, antecedent, consequent):
        self.antecedent = antecedent
        self.consequent = consequent
        
    def get_antecedent(self):
        return self.antecedent
    
    def get_consequent(self):
        return self.consequent
    
    def __str__(self):
        return str(self.antecedent) + " -> " + str(self.consequent)

def get_fact(A,B,C,D):
    facts = []
    if A >= 50:
        facts.append("E")
    else:
        facts.append("F")
    if B >= 2:
        facts.append("G")
    else:
        facts.append("H")
    if C >= 5000:
        facts.append("I")
    else:
        facts.append("J")
    if D >= 30:
        facts.append("K")
    else:
        facts.append("L")
    
    return facts

def solve(facts):
    R1 = Rule("A >= 50", "E")
    R2 = Rule("A < 50", "F")
    R3 = Rule("B >= 2", "G")
    R4 = Rule("B < 2", "H")
    R5 = Rule("C >= 5000", "I")
    R6 = Rule("C < 5000", "J")
    R7 = Rule("D >= 30", "K")
    R8 = Rule("D < 30", "L")
    R9 = Rule("I AND K", "M")
    R10 = Rule("J AND K", "M")
    R11 = Rule("I AND L", "N")
    R12 = Rule("J AND L", "N")
    R13 = Rule("E AND H", "O")
    R14 = Rule("E AND G", "O")
    R15 = Rule("F AND H", "O")
    R16 = Rule("F AND G", "P")
    R17 = Rule("O AND M", "X")
    R18 = Rule("O AND N", "X")
    R19 = Rule("P AND M", "X")
    R20 = Rule("P AND N", "Y")
    # rules = (R1,R2,R3,R4,R5,R6,R7,R8,R9,R10,R11,R12,R13,R14,R15,R16,R17,R18,R19,R20)
    rules = (R9,R10,R11,R12,R13,R14,R15,R16,R17,R18,R19,R20)
    
    while True:
        for rule in rules:
            antecedents = rule.get_antecedent().split("AND")
            if antecedents[0].strip() in facts and antecedents[1].strip() in facts:
                facts.append(rule.get_consequent().strip())  
        if "X" in facts:
            print("Daerah berbahaya untuk dikunjungi")
            break
        elif "Y" in facts:
            print("Daerah aman untuk dikunjungi")
            break

if __name__ == "__main__":
    '''
    A => curah hujan
    B => luas daerah resapan
    C => banyak pohon
    D => kecepatan angin
    '''
    # A = float(input("Masukkan curah hujan (mm/hari) : "))
    # B = float(input("Masukkan luas daerah resapan (hektar): "))
    # C = int(input("Masukkan banyak pohon : "))
    # D = float(input("Masukkan kecepatan angin (km/jam) : "))
    
    A = 120
    B = 2.5
    C = 8000
    D = 12.5
    solve(get_fact(A,B,C,D))