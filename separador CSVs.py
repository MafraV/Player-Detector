import csv

dataset1 = csv.reader(open('C:/episodes/set.csv', 'r'), delimiter=",", quotechar='|')
dataset2 = csv.reader(open('C:/episodes/set.csv', 'r'), delimiter=",", quotechar='|')
dataset3 = csv.reader(open('C:/episodes/set.csv', 'r'), delimiter=",", quotechar='|')
dataset4 = csv.reader(open('C:/episodes/set.csv', 'r'), delimiter=",", quotechar='|')

time = [row[0] for row in dataset1]
players = [row[1] for row in dataset2]
x = [row[2] for row in dataset3]
y = [row[3] for row in dataset4]

tam = len(time)

time1 = []
x1 = []
y1 = []

for i in range(0,tam):
    if (players[i] == '1'):
        time1.append(time[i])
        x01 = float(x[i])
        y01 = float(y[i])
        x01 = float("{:.3f}".format(x01))
        y01 = float("{:.3f}".format(y01))
        x1.append(x01)
        y1.append(y01)
        
with open('C:/episodes/player1.csv', 'w', newline='') as file:
    writer = csv.writer(file)
    writer.writerow(["TimeStamp", "X axis", "Y axis"])
    tam = len(time1)
    for i in range(0,tam):
        writer.writerow([time1[i], x1[i], y1[i]])     

print("done")
