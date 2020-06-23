import csv

player1x = csv.reader(open('C:/episodes/Players Melhorados/player1-final.csv', 'r'), delimiter=",", quotechar='|')
player1y = csv.reader(open('C:/episodes/Players Melhorados/player1-final.csv', 'r'), delimiter=",", quotechar='|')

player2x = csv.reader(open('C:/episodes/Players Melhorados/player2-final.csv', 'r'), delimiter=",", quotechar='|')
player2y = csv.reader(open('C:/episodes/Players Melhorados/player2-final.csv', 'r'), delimiter=",", quotechar='|')

player5x = csv.reader(open('C:/episodes/Players Melhorados/player5-final.csv', 'r'), delimiter=",", quotechar='|')
player5y = csv.reader(open('C:/episodes/Players Melhorados/player5-final.csv', 'r'), delimiter=",", quotechar='|')

player7x = csv.reader(open('C:/episodes/Players Melhorados/player7-final.csv', 'r'), delimiter=",", quotechar='|')
player7y = csv.reader(open('C:/episodes/Players Melhorados/player7-final.csv', 'r'), delimiter=",", quotechar='|')

player8x = csv.reader(open('C:/episodes/Players Melhorados/player8-final.csv', 'r'), delimiter=",", quotechar='|')
player8y = csv.reader(open('C:/episodes/Players Melhorados/player8-final.csv', 'r'), delimiter=",", quotechar='|')

player9x = csv.reader(open('C:/episodes/Players Melhorados/player9-final.csv', 'r'), delimiter=",", quotechar='|')
player9y = csv.reader(open('C:/episodes/Players Melhorados/player9-final.csv', 'r'), delimiter=",", quotechar='|')

player10x = csv.reader(open('C:/episodes/Players Melhorados/player10-final.csv', 'r'), delimiter=",", quotechar='|')
player10y = csv.reader(open('C:/episodes/Players Melhorados/player10-final.csv', 'r'), delimiter=",", quotechar='|')

player12x = csv.reader(open('C:/episodes/Players Melhorados/player12-final.csv', 'r'), delimiter=",", quotechar='|')
player12y = csv.reader(open('C:/episodes/Players Melhorados/player12-final.csv', 'r'), delimiter=",", quotechar='|')

player13x = csv.reader(open('C:/episodes/Players Melhorados/player13-final.csv', 'r'), delimiter=",", quotechar='|')
player13y = csv.reader(open('C:/episodes/Players Melhorados/player13-final.csv', 'r'), delimiter=",", quotechar='|')

player14x = csv.reader(open('C:/episodes/Players Melhorados/player14-final.csv', 'r'), delimiter=",", quotechar='|')
player14y = csv.reader(open('C:/episodes/Players Melhorados/player14-final.csv', 'r'), delimiter=",", quotechar='|')

player15x = csv.reader(open('C:/episodes/Players Melhorados/player15-final.csv', 'r'), delimiter=",", quotechar='|')
player15y = csv.reader(open('C:/episodes/Players Melhorados/player15-final.csv', 'r'), delimiter=",", quotechar='|')

x1 = [row[0] for row in player1x]
y1 = [row[1] for row in player1y]

x2 = [row[0] for row in player2x]
y2 = [row[1] for row in player2y]

x5 = [row[0] for row in player5x]
y5 = [row[1] for row in player5y]

x7 = [row[0] for row in player7x]
y7 = [row[1] for row in player7y]

x8 = [row[0] for row in player8x]
y8 = [row[1] for row in player8y]

x9 = [row[0] for row in player9x]
y9 = [row[1] for row in player9y]

x10 = [row[0] for row in player10x]
y10 = [row[1] for row in player10y]

x12 = [row[0] for row in player12x]
y12 = [row[1] for row in player12y]

x13 = [row[0] for row in player13x]
y13 = [row[1] for row in player13y]

x14 = [row[0] for row in player14x]
y14 = [row[1] for row in player14y]

x15 = [row[0] for row in player15x]
y15 = [row[1] for row in player15y]

tam = len(x1)

for i in range(1,tam):
    with open('C:/episodes/Momentos/momento '+str(i)+'.csv', 'w', newline='') as file:
        writer = csv.writer(file)
        writer.writerow(["X", "Y"])
        writer.writerow([x1[i], y1[i]])
        writer.writerow([x2[i], y2[i]])
        writer.writerow([x5[i], y5[i]])
        writer.writerow([x7[i], y7[i]])
        writer.writerow([x8[i], y8[i]])
        writer.writerow([x9[i], y9[i]])
        writer.writerow([x10[i], y10[i]]) 
        writer.writerow([x12[i], y12[i]])
        writer.writerow([x13[i], y13[i]])
        writer.writerow([x14[i], y14[i]])
        writer.writerow([x15[i], y15[i]])
    
print("done")