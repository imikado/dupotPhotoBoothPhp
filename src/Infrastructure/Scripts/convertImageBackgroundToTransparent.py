import subprocess
import os
import shlex

import sys

print('Number of arguments:'+str(len(sys.argv)-1) + ' arguments.')
print('Argument List:' + str(sys.argv))

if (len(sys.argv) != 3):
    print('Usage: ' + os.path.basename(__file__) +
          ' imageFrom.jpg imageFrom.jpg.transparent.png')
    exit()

imageOrigin = sys.argv[1]
imageTarget = sys.argv[2]


command_line = "/usr/bin/convert -limit thread 4 "+imageOrigin + \
    "[1x1+10+10] -format '%[fx:int(255*r)],%[fx:int(255*g)],%[fx:int(255*b)]' info:"
args = shlex.split(command_line)
print(args)
out = subprocess.Popen(args, stdout=subprocess.PIPE)
output, err = out.communicate()
print(str(output))
stroutput = str(output)
start = stroutput.split("'")
print(start)
rgb = start[1].split(",")
print(rgb)
red = int(rgb[0])
green = int(rgb[1])
blue = int(rgb[2])
print(red)
print(green)
print(blue)

print("red is" + str(hex(red)))
redh = str(hex(red))
greenh = str(hex(green))
blueh = str(hex(blue))

print("redh is " + redh)
print("greenh is " + greenh)
print("blueh is " + blueh)

print("redh most right " + redh[len(redh)-1])
print("led redh " + str(len(redh)))

if len(redh) == 3:
    redhash = "0" + redh[len(redh)-1]
else:
    redhash = str(redh[2:])
print("redhash is " + redhash)

if len(greenh) == 3:
    greenhash = "0" + greenh[len(greenh)-1]
else:
    greenhash = str(greenh[2:])
print("greenhash is " + greenhash)

if len(blueh) == 3:
    bluehash = "0" + blueh[len(blueh)-1]
else:
    bluehash = str(blueh[2:])

print("bluehash is " + bluehash)
rgbnum = redhash + greenhash + bluehash
print(rgbnum)


# convert jpg to png

print("get transparent image")
commandis = '/usr/bin/convert '+imageOrigin + \
    ' -fuzz 20%% -transparent "#'+rgbnum + '" '+imageTarget


# add transparency to image based on sample from above.
# commandis = '/usr/bin/convert -limit thread 4 ' + imageOrigin + 'imagecam.png -fuzz ' + \
#    fuzzpercent+' -transparent "#'+rgbnum + ' " ' + folder + 'imagecamt.png'
print(commandis)
os.system(commandis)
