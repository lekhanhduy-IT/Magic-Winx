let mediaRecorder;
let recordedChunks = [];

async function startRecording() {
  try {
    const stream = await navigator.mediaDevices.getDisplayMedia({
      video: { mediaSource: "screen" }
    });
    
    mediaRecorder = new MediaRecorder(stream);
    
    mediaRecorder.ondataavailable = function(event) {
      if (event.data.size > 0) {
        recordedChunks.push(event.data);
      }
    };
    
    mediaRecorder.onstop = function() {
      const blob = new Blob(recordedChunks, {
        type: "video/webm"
      });
      const url = URL.createObjectURL(blob);
      const a = document.createElement('a');
      document.body.appendChild(a);
      a.style = 'display: none';
      a.href = url;
      a.download = 'recording.webm';
      a.click();
      window.URL.revokeObjectURL(url);
    };
    
    mediaRecorder.start();
    
    console.log("Recording started...");
  } catch (err) {
    console.error("Error: " + err);
  }
}

function stopRecording() {
  if (mediaRecorder) {
    mediaRecorder.stop();
    console.log("Recording stopped.");
  }
}
